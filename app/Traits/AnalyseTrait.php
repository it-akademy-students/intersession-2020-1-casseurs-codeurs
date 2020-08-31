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
                file_put_contents(base_path().'/public/reports/'.$baseFileName.'_'.$tool.'.json', $output);
            }
                return ['response' => 'success' , 'value' => $output];
        } catch (\Exception $exception) {
            return['response' => 'error' , $exception->getMessage()];
        }

    }
}
