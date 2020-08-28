<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessSecurity;
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
     * @return false|string
     * Renvoie la date à laquelle la limite sera remis à 0
     */
    private function getRateLimitInfo(){
        $curl = curl_init("https://api.github.com/rate_limit");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_USERAGENT,'User-Agent: PHP');
        $content = curl_exec($curl);
        curl_close($curl);
        // Ajouter 2 heure pour obtenir heure fr:
        return date('d-m-Y H:i:s', json_decode($content)->rate->reset +7200);
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
            $list = $this->getGithubContent($listingUrl);
            // Cas d'erreur: retourner le message d'erreur de Github
            if (isset($list->message)){
                strpos($list->message, 'API rate limit exceeded') !== false ? ($code = 403 AND $reset = $this->getRateLimitInfo()) : ($code = 404 AND $reset = null);
                return ['response' => 'error', 'code' => $code, 'message' => $list->message, 'url' => $baseUrl, 'reset' => $reset];
            }
            else{
                $this->dispatch(new ProcessSecurity(json_encode($list), $baseUrl, $username.'_'.$repos));
                header('Content-Type: application/json');
                return ['response' => 'success', 'code' => 200];
            }
        } catch (Exeption $e){
            return $e->getMessage();
        }

    }

}
