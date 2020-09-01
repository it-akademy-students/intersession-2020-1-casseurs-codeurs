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

    public function analyse(string $tool, string $baseFileName){

        if ($tool == 'phpstan'){// Analyze with PHPStan : errors research in the code
            $prefix='';
            $workingPath = base_path() . '\vendor\bin\phpstan'; // Windows path with backslashes
            // $workingPath = base_path() . '/vendor/bin/phpstan'; // Linux path with slashes
            $cmd = ' analyse ';
            $option = '--error-format=prettyJson --no-progress -c ' . base_path() . '\config\configuration.neon'; // Windows path with backslashes
            // $option = '--error-format=prettyJson --no-progress -c ' . base_path() . '/config/configuration.neon'; // Linux path with slashes
            $exec = $prefix . $workingPath . $cmd . $option;
            //dd($exec);
        }elseif ($tool == 'progpilot'){// Analyze with ProgPilot : security threats test
            $prefix='';
            $workingPath = base_path() . '\vendor\bin\progpilot '; // Windows path with backslashes
            // $workingPath = base_path() . '/vendor/bin/progpilot '; // Linux path with slashes
            $cmd = '';
            //$option = '';
            $option = '--configuration ' . base_path() . '\config\configuration.yml'; // Windows path with backslashes
            // $option = '--configuration ' . base_path() . '/config/configuration.yml'; // Linux path with slashes
            $exec = $prefix . $workingPath . $cmd . $option;
            //dd($exec);
        }elseif ($tool == 'php7mar'){// Analyze with php7mar : Migration Assistant Report between PHP 5 & PHP 7
            $prefix = 'php ';
            $workingPath = base_path() . '\app\php7mar\mar.php'; // Windows path with backslashes
            // $workingPath = base_path() . '/app/php7mar/mar.php'; // Linux path with slashes
            $cmd = '';
            $option = '';
            $scanPath = ' -f="' . base_path() . '\public\scan"'; // Windows path with backslashes
            // $scanPath = ' -f="' . base_path() . '/public/scan"';// Linux path with slashes
            $reportsPath = ' -r="' . base_path() . '\public\reports"'; // Windows path with backslashes
            // $reportsPath = ' -r="' . base_path() . '/public/reports"'; // Linux path with slashes
            $exec = $prefix . $workingPath . $cmd . $option . $scanPath . $reportsPath;
            //dd($exec);
        }

        try{
            exec($exec , $output);
            if ($tool != 'php7mar'){
                $this->convertOutput($tool, $output);
                }
            return ['response' => 'success' , 'value' => $output];
        } catch (\Exception $exception) {
            return['response' => 'error' , $exception->getMessage()];
        }

    }

    private function convertOutput(string $tool, $output){
        if ($tool == 'phpstan'){
            $output = json_decode($output[0]);
            $errorsQuantity = $output->totals->errors;
            $phpstanResult = [];
            $outFile = base_path().'\public\reports\errorsCode.md';
            if($errorsQuantity){
                foreach($convertedDatas->files as $key => $file){
                    if($file->errors){
                        $messages = $file->messages;
                        $i = 0;
                        foreach($messages as $message){
                            if(!$message->ignorable){
                                $i++;
                                $filename = str_replace(base_path().'\public\scan\\', '', $key);
                                $phpstanResult[$filename][$i] = [
                                    'message' => $message->message,
                                    'line' => $message->line,
                                ];
                            }
                        }
                    }
                }
                file_put_contents($outFile, "# Fichier(s) incriminé(s)\n\n");
                foreach($phpstanResult as $key => $errors){
                    file_put_contents($outFile, "##".$key."\n\n", FILE_APPEND);
                    foreach($errors as $errorKey => $error){
                        $message = $error['message'];
                        $line = $error['line'];
                        file_put_contents($outFile, "**Error $errorKey**<br>\n&nbsp;&nbsp;&nbsp;__message:__  $message\n<br>&nbsp;&nbsp;&nbsp;__line:__$line\n<br>", FILE_APPEND);
                    }
                    file_put_contents($outFile, "\n", FILE_APPEND);
                }
                return ['errorQuantity' => $errorsQuantity, 'file' => $outFile];
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
                foreach($output as $error){
                    $filename = str_replace(base_path().'\public\scan\\', '', $error->sink_file);
                    array_key_exists($filename,$progpilotResult) ? $i = sizeof($progpilotResult[$filename]) : $i = 0;
                    $progpilotResult[$filename][$i] = [
                        'source_name' => $error->source_name[0],
                        'source_line' => $error->source_line[0],
                        'sink_name' => $error->sink_name,
                        'vuln_name' => $error->vuln_name,
                        'vuln_cwe' => $error->vuln_cwe,
                        'vuln_type' => $error->vuln_type
                    ];
                }
                file_put_contents($outFile, "# Fichier(s) incriminé(s)\n\n");
                foreach($progpilotResult as $key => $errors){
                    file_put_contents($outFile, "##$key<br>", FILE_APPEND);
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
