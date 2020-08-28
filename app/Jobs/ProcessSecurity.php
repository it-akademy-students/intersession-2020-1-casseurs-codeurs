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
