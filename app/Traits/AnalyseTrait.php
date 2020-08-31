<?php

namespace App\Traits;

trait AnalyseTrait
{
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
