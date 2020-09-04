<?php

namespace App\Jobs;

use App\Mail\AnalyseMail;
use App\Models\AnalyseModel;
use App\Models\User;
use App\Models\Statistic;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\AnalyseTrait;
use Illuminate\Support\Facades\Mail;

class ProcessSecurity implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    use AnalyseTrait;
    /**
     * @var string
     */
    private $list;
    /**
     * @var string
     */
    private $baseUrl;
    /**
     * @var string
     */
    private $githubInfo;
    /**
     * @var string
     */
    private $email;
    /**
     * @var int
     */
    private $migration;
    /**
     * @var int
     */
    private $userConnected;

    /**
     * ProcessSecurity constructor.
     * @param string $list
     * @param string $baseUrl
     * @param string $githubInfo
     * @param string $email
     * @param int $migration
     * @param int $userConnected
     */
    public function __construct( string $list, string $baseUrl, string $githubInfo, string $email, int $migration, int $userConnected)
    {
        $this->list = $list;
        $this->baseUrl = $baseUrl;
        $this->githubInfo = $githubInfo;
        $this->email = $email;
        $this->migration = $migration;
        $this->userConnected = $userConnected;
    }

    private function is_dir_empty($dir) {
        $handle = opendir($dir);
        while (false !== ($entry = readdir($handle))) {
            if ($entry != "." && $entry != "..") {
                closedir($handle);
                return FALSE;
            }
        }
        closedir($handle);
        return TRUE;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $authorization = false;
        //____________________Copie en local des fichiers php cibles________________________////
        $list = json_decode($this->list);
        // On récupère les chemin des fichiers php du repos:
        $paths = [];
        foreach ($list->tree as $tree){
            if (substr($tree->path, -4) == '.php' && strpos($tree->path, 'vendor') === false && strpos($tree->path, 'node_modules') === false){
                $paths[] = $tree->path;
            }
        }
        $baseContentUrl = $this->baseUrl . "contents/";
        foreach ($paths as $path){
            //$baseContentUrl . path pour récupérer le contenu du fichier:
            $content = base64_decode($this->getGithubContent($baseContentUrl.$path)->content);
            $this->addFile($path, $content, realpath(base_path().'/public/Scan/'));
        }
        $files = [];
        if ($this->migration == 0){
            //____________________Analyse PHPStan________________________////
            $result = $this->analyse('phpstan');
            $errorFound = $result['errorQuantity'];
            if ($errorFound){
                $files[] = $result['file'];
            }
            //____________________Analyse Progpilot________________________////
            $result = $this->analyse('progpilot');
            $securityFails = $result['errorQuantity'];
            if ($securityFails){
                $files[] = $result['file'];
            }
            $migrationAssistance = 0;
            $authorization = true;
        }
        elseif ($this->migration == 1 && $this->userConnected != 0){
            //____________________Analyse PHPStan________________________////
            $result = $this->analyse('phpstan');
            $errorFound = $result['errorQuantity'];
            if ($errorFound){
                $files[] = $result['file'];
            }
            //____________________Analyse Progpilot________________________////
            $result = $this->analyse('progpilot');
            $securityFails = $result['errorQuantity'];
            if ($securityFails){
                $files[] = $result['file'];
            }
            //____________________Analyse PHP7mar________________________////
            $this->analyse('php7mar');
            $files[] = realpath(base_path().'/public/reports/migration.md');
            $migrationAssistance = 1;
            $authorization = true;
        }
        elseif ($this->migration == 2 && $this->userConnected != 0){
            //____________________Analyse PHP7mar________________________////
            $this->analyse('php7mar');
            $files[] = realpath(base_path().'/public/reports/migration.md');
            $migrationAssistance = 1;
            $errorFound = 0;
            $securityFails = 0;
            $authorization = true;
        }
        //Vérifié si l'autorisation au différent type d'analyse est respecté (si aucun utilisateur et $migration != 0)
        if ($authorization) {
            //Envoie du resultat par mail:
            $project = str_replace("_", "/", "$this->githubInfo");
            Mail::to($this->email)->send(new AnalyseMail($files, $project));

            if ($this->userConnected) {
                $user = User::find($this->userConnected);
                // Conserver les fichiers pour les utilisateur connectés:
                $newFiles = [];
                foreach ($files as $file) {
                    $newFilename = str_replace('public\reports\\', 'storage\users\\' . $user->name . '_' . $this->githubInfo, $file);
                    rename($file, $newFilename);
                    $newFiles[] = $newFilename;
                }
                //Nombre de fichier scannés:
                $scannedFiles = sizeof($paths);
                // Associer l'analyse à l'utilisateur dans la base de donnée:
                //On vérifie l'existance d'un précédent scan sur le repos:
                $analyse = AnalyseModel::where([
                    ['repository', '=', str_replace("_", "/", "$this->githubInfo")],
                    ['user_id', '=', $user->id],
                ])->first();
                // Si le repos à déjà été scanné:
                if ($analyse != null) {
                    $analyse->errorsFound = $errorFound;
                    if ($analyse->maxErrorsFound < $errorFound) {
                        $analyse->maxErrorsFound = $errorFound;
                    }
                    $analyse->totalErrorsFound += $errorFound;
                    $analyse->securityFails = $securityFails;
                    if ($analyse->maxSecurityFails < $securityFails) {
                        $analyse->maxSecurityFails = $securityFails;
                    }
                    $analyse->totalSecurityFails += $securityFails;
                    $analyse->scannedFiles = $scannedFiles;
                    $analyse->numberOfScans += 1;
                    $analyse->files = json_encode($newFiles);
                    $analyse->save();
                } else {
                    $analyse = new AnalyseModel();
                    $analyse->repository = str_replace("_", "/", "$this->githubInfo");
                    $analyse->errorsFound = $errorFound;
                    $analyse->maxErrorsFound = $errorFound;
                    $analyse->totalErrorsFound = $errorFound;
                    $analyse->securityFails = $securityFails;
                    $analyse->maxSecurityFails = $securityFails;
                    $analyse->totalSecurityFails = $securityFails;
                    $analyse->scannedFiles = $scannedFiles;
                    $analyse->numberOfScans = 1;
                    $analyse->files = json_encode($newFiles);

                    $user->analyses()->save($analyse);
                }
            } else {
                //Suppression des fichiers:
                // reports:
                $dir = realpath(base_path() . '/public/reports');
                if (!$this->is_dir_empty($dir)) {
                    $di = new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS);
                    $ri = new \RecursiveIteratorIterator($di, \RecursiveIteratorIterator::CHILD_FIRST);
                    foreach ($ri as $file) {
                        $file->isDir() ? rmdir($file) : unlink($file);
                    }
                }
            }
            //Suppression des fichiers:
            // Scan:
            $dir = realpath(base_path() . "/public/Scan");
            if (!$this->is_dir_empty($dir)) {
                $di = new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS);
                $ri = new \RecursiveIteratorIterator($di, \RecursiveIteratorIterator::CHILD_FIRST);
                foreach ($ri as $file) {
                    $file->isDir() ? rmdir($file) : unlink($file);
                }
            }
            //On met à jour les statistiques général de l'application:
            $statistic = Statistic::first();
            $statistic->errorsFound += $errorFound;
            $statistic->securityFails += $securityFails;
            $statistic->scannedFiles += $scannedFiles;
            $statistic->repositoryScanned += 1;
            $statistic->migrationAssistance += $migrationAssistance;
            $statistic->save();
        }
    }

    public function failed($exception)
    {
        file_put_contents(base_path().'/storage/logs/processSecurity.log', PHP_EOL . $exception->getMessage(), FILE_APPEND);
    }
}
