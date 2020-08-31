<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Traits\AnalyseTrait;

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
     * ProcessSecurity constructor.
     * @param $list
     * @param string $baseUrl
     */
    public function __construct( string $list, string $baseUrl, string $githubInfo)
    {
        $this->list = $list;
        $this->baseUrl = $baseUrl;
        $this->githubInfo = $githubInfo;
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
        //____________________Analyse PHP7mar________________________////
        $this->analyse('php7mar', $this->githubInfo);
        //____________________Analyse Progpilot________________________////
        $this->analyse('progpilot', $this->githubInfo);
    }

}
