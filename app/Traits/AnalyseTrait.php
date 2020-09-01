<?php

namespace App\Traits;

trait AnalyseTrait
{
    /**
     * @param $url
     * @return mixed
     * Permet de récupérer le contenu de l'appel vers l'API Github
     */
    private function getGithubContent($url){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERAGENT,'User-Agent: PHP');
        $content = curl_exec($curl);
        curl_close($curl);

        return json_decode($content);
    }

    /**
     * @param $path
     * @param $content
     * @param string $baseFolder
     * Permet de créer l'architecture des sous dossier si nécéssaire
     * Créer le fichier
     */
    private function addFile($path, $content, $baseFolder){
        $folders = explode("/", $path);
        $quantity = sizeof($folders)-1;
        if ($quantity != 0){
            $folderPath = str_replace(end($folders),"", $path);
            if (!file_exists($baseFolder.$folderPath)){
                mkdir($baseFolder.$folderPath, 0644, true);
            }
        }
        file_put_contents($baseFolder.$path, $content);
    }

    public function analyse(string $tool){

        if ($tool == 'phpstan'){// Analyze with PHPStan : errors research in the code
            $prefix='';
            $workingPath = base_path() . '\vendor\bin\phpstan'; // Windows path with backslashes
            // $workingPath = base_path() . '/vendor/bin/phpstan'; // Linux path with slashes
            $cmd = ' analyse ';
            $option = '--error-format=prettyJson --no-progress -c ' . base_path() . '\config\configuration.neon'; // Windows path with backslashes
            // $option = '--error-format=prettyJson --no-progress -c ' . base_path() . '/config/configuration.neon'; // Linux path with slashes
            $exec = $prefix . $workingPath . $cmd . $option;
        }elseif ($tool == 'progpilot'){// Analyze with ProgPilot : security threats test
            $prefix='';
            $workingPath = base_path() . '\vendor\bin\progpilot '; // Windows path with backslashes
            // $workingPath = base_path() . '/vendor/bin/progpilot '; // Linux path with slashes
            $option = '--configuration ' . base_path() . '\config\configuration.yml'; // Windows path with backslashes
            // $option = '--configuration ' . base_path() . '/config/configuration.yml'; // Linux path with slashes
            $exec = $prefix . $workingPath . $option;
        }elseif ($tool == 'php7mar'){// Analyze with php7mar : Migration Assistant Report between PHP 5 & PHP 7
            $prefix = 'php ';
            $workingPath = base_path() . '\app\php7mar\mar.php'; // Windows path with backslashes
            // $workingPath = base_path() . '/app/php7mar/mar.php'; // Linux path with slashes
            $scanPath = ' -f="' . base_path() . '\public\scan"'; // Windows path with backslashes
            // $scanPath = ' -f="' . base_path() . '/public/scan"';// Linux path with slashes
            $reportsPath = ' -r="' . base_path() . '\public\reports"'; // Windows path with backslashes
            // $reportsPath = ' -r="' . base_path() . '/public/reports"'; // Linux path with slashes
            $exec = $prefix . $workingPath . $scanPath . $reportsPath;
        }
        try{
            //On execute la commande:
            exec($exec , $output);
            // php7mar renvoie un format md, pour les autres il faut les convertir:
            if ($tool != 'php7mar'){
                return $this->convertOutput($tool, $output);
            }
            return ['response' => 'success' , 'file' => base_path() . '\public\reports\migration.md'];
        } catch (\Exception $exception) {
            return['response' => 'error' , $exception->getMessage()];
        }

    }

    /**
     * @param string $tool
     * @param $output
     * @return array
     * Permet de convertir la sortie de l'excution de la commande en format markdown
     */
    private function convertOutput(string $tool, $output){
        if ($tool == 'phpstan') {
            $output = json_decode($output[0]);
            $errorsQuantity = $output->totals->errors;
            $phpstanResult = [];
            $outFile = base_path() . '\public\reports\errorsReport.md';
            if ($errorsQuantity) {
                //On recupère tout les rapport par fichiers retournés par l'analyse:
                foreach ($output->files as $key => $file) {
                    if ($file->errors) {
                        $messages = $file->messages;
                        $i = 0;
                        // On parcours tout les messages d'erreur relatif à ce fichier:
                        foreach ($messages as $message) {
                            // Si cette erreur ne peut pas être ignorée (selon le niveau definie dans la configuration.yml):
                            if (!$message->ignorable) {
                                $i++;
                                $filename = str_replace(base_path() . '\public\scan\\', '', $key);
                                // On associe le nom du fichier à l'erreur:
                                $phpstanResult[$filename][$i] = [
                                    'message' => $message->message,
                                    'line' => $message->line,
                                ];
                            }
                        }
                    }
                }
                //On crée le fichier de rapport .md:
                file_put_contents($outFile, "# Fichier(s) incriminé(s)\n\n");
                foreach ($phpstanResult as $key => $errors) {
                    // Ajouter une ligne avec le nom du fichier:
                    file_put_contents($outFile, "##" . $key . "\n\n", FILE_APPEND);
                    // Ajouter des lignes message et line pour chaque erreur:
                    foreach ($errors as $errorKey => $error) {
                        $message = $error['message'];
                        $line = $error['line'];
                        file_put_contents($outFile, "**Error $errorKey**<br>\n&nbsp;&nbsp;&nbsp;__message:__  $message\n<br>&nbsp;&nbsp;&nbsp;__line:__$line\n<br>", FILE_APPEND);
                    }
                    file_put_contents($outFile, "\n", FILE_APPEND);
                }
                return ['errorQuantity' => $errorsQuantity, 'file' => $outFile];
            }
        }
        elseif ($tool == 'progpilot'){
            $json = '';
            foreach($output as $value){
                $json .= $value;
            }
            $output = json_decode($json);
            $errorQuantity = sizeof($output);
            $progpilotResult = [];
            $outFile = base_path().'\public\reports\securityFails.md';
            if($errorQuantity){
                // On récupère toutes les erreurs retournées par l'analyse:
                foreach($output as $error){
                    $filename = str_replace(base_path().'\public\scan\\', '', $error->sink_file);
                    // Ajouter une nouvelle key associée au la key du fichier si elle existe déjà:
                    array_key_exists($filename,$progpilotResult) ? $i = sizeof($progpilotResult[$filename]) : $i = 0;
                    // On associe le nom du fichier à l'erreur:
                    $progpilotResult[$filename][$i] = [
                        'source_name' => $error->source_name[0],
                        'source_line' => $error->source_line[0],
                        'sink_name' => $error->sink_name,
                        'vuln_name' => $error->vuln_name,
                        'vuln_cwe' => $error->vuln_cwe,
                        'vuln_type' => $error->vuln_type
                    ];
                }
                //On crée le fichier de rapport .md:
                file_put_contents($outFile, "# Fichier(s) incriminé(s)\n\n");
                foreach($progpilotResult as $key => $errors){
                    // Ajouter une ligne avec le nom du fichier:
                    file_put_contents($outFile, "##$key<br>", FILE_APPEND);
                    // Ajouter des lignes pour chacune des valeurs du tableau $progpilotResult pour chaque erreur:
                    foreach($errors as $errorKey => $error){
                        $vulnName = $error['vuln_name'];
                        $vulnCwe = $error['vuln_cwe'];
                        $vulnType = $error['vuln_type'];
                        $sourceName = $error['source_name'];
                        $sourceLine = $error['source_line'];
                        $sinkName = $error['sink_name'];
                        file_put_contents($outFile, "**Error $errorKey**<br>&nbsp;&nbsp;&nbsp;*vuln_name:*$vulnName<br>&nbsp;&nbsp;&nbsp;*vuln_cwe:*$vulnCwe<br>&nbsp;&nbsp;&nbsp;*vuln_type:*$vulnType<br>&nbsp;&nbsp;&nbsp;*entry_point:*$sourceName<br>&nbsp;&nbsp;&nbsp;*line:*$sourceLine<br>&nbsp;&nbsp;&nbsp;*sink_name:*$sinkName<br>\n", FILE_APPEND);
                    }
                }
                return ['errorQuantity' => $errorQuantity, 'file' => $outFile];
            }
        }
    }
}
