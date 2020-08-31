<?php

namespace App\Jobs;

use App\Mail\Analyse;
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
     * ProcessSecurity constructor.
     * @param $list
     * @param string $baseUrl
     */
    public function __construct( string $list, string $baseUrl, string $githubInfo, string $email)
    {
        $this->list = $list;
        $this->baseUrl = $baseUrl;
        $this->githubInfo = $githubInfo;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //____________________Copie en local des fichiers php cibles________________________////
        $list = json_decode($this->list);
        // On récupère les chemin des fichiers php du repos:
        $paths = [];
        foreach ($list->tree as $tree){
            if (substr($tree->path, -4) == '.php'){
                $paths[] = $tree->path;
            }
        }
        $baseContentUrl = $this->baseUrl . "contents/";
        foreach ($paths as $path){
            //$baseContentUrl . path pour récupérer le contenu du fichier:
            $content = base64_decode($this->getGithubContent($baseContentUrl.$path)->content);
            $this->addFile($path, $content, base_path().'/public/Scan/');
        }
        //____________________Analyse PHPStan________________________////
        $this->analyse('phpstan', $this->githubInfo);
        $phpstanPath = base_path().'/public/reports/'.$this->githubInfo.'_phpstan.json';
        //____________________Analyse PHP7mar________________________////
        $this->analyse('php7mar', $this->githubInfo);
        $php7marPath = base_path().'/public/reports/php7mar.md';
        //____________________Analyse Progpilot________________________////
        $this->analyse('progpilot', $this->githubInfo);
        $progpilotPath = base_path().'/public/reports/'.$this->githubInfo.'_progpilot.json';
        $files = [
            $phpstanPath,
            $php7marPath,
            $progpilotPath
        ];
        //Envoie du resultat par mail:
        $project = str_replace("_","/","$this->githubInfo");
        Mail::to($this->email)->send(new Analyse($files, $project));

//      Suppression des fichiers:
        // reports:
        unlink("$phpstanPath");
        unlink("$php7marPath");
        unlink("$progpilotPath");
        // Scan:
        $dir = base_path()."\public\Scan";
        $di = new \RecursiveDirectoryIterator($dir, \FilesystemIterator::SKIP_DOTS);
        $ri = new \RecursiveIteratorIterator($di, \RecursiveIteratorIterator::CHILD_FIRST);
        foreach ( $ri as $file ) {
            $file->isDir() ?  rmdir($file) : unlink($file);
        }
    }

}
