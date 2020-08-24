<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
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
    private function addFile($path, $content, $baseFolder = 'Scan/'){
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
     * @param string $username
     * @param string $repos
     * @return array|string
     */
    public function github(string $username, string $repos)
    {
        try{
            //Construction de l'url a appelé:
            $baseUrl = "https://api.github.com/repos/$username/$repos/";
            //Url API v3 Github pour lister l'architecture d'un repos:
            $listingUrl = $baseUrl."git/trees/master?recursive=1";
            $content = $this->getGithubContent($listingUrl);
            // Cas d'erreur: retourner le message d'erreur de Github
            if (isset($content->message)){
                strpos($content->message, 'API rate limit exceeded') !== false ? $code = 403 : $code = 404;
                return ['type' => 'Error', 'code' => $code, 'message' => $content->message, 'url' => $baseUrl];
            }
             else{
                 //On récupère les chemin des fichiers php du repos:
                $paths = [];
                foreach ($content->tree as $tree){
                    if (substr($tree->path, -4) == '.php'){
                        $paths[] = $tree->path;
                    }
                }
                $baseContentUrl = $baseUrl . "contents/";
                foreach ($paths as $path){
                    //$baseContentUrl . path pour récupérer le contenu du fichier:
                    $content = base64_decode($this->getGithubContent($baseContentUrl.$path)->content);
                    $this->addFile($path, $content);
                }
                header('Content-Type: application/json');
                return ['type' => 'Success', 200];
            }
        } catch (Exeption $e){
            return $e->getMessage();
        }

    }

}
