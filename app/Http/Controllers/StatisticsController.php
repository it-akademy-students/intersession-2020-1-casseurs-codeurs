<?php

namespace App\Http\Controllers;

use App\Analyse;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function totalPerUser(int $id){
        try{
            $analyses = Analyse::where([
                ['user_id', '=', $id ],
            ])->get()->toArray();
            $total['scannedFiles'] = $total['numberOfScans'] = $total['totalErrorsFound'] = $total['totalSecurityFails'] = 0;
            foreach ($analyses as $analyse){
                $total['scannedFiles'] += ($analyse['scannedFiles'] * $analyse['numberOfScans']);
                $total['numberOfScans'] += $analyse['numberOfScans'];
                $total['totalErrorsFound'] += $analyse['totalErrorsFound'];
                $total['totalSecurityFails'] += $analyse['totalSecurityFails'];
            }
            $total['totalRepository'] = sizeof($analyses);
            return ['response' => 'success', 'code' => 200, 'data' => $total];
        } catch (Exeption $e){
            return ['response' => 'error', 'code' => $e->getCode(), 'message' => $e->getMessage()];
        }
    }

    public function repositoryPerUser(int $id){
        try{
            $analyses = Analyse::where([
                ['user_id', '=', $id ],
            ])->get()->toArray();
            $list = [];
            foreach ($analyses as $analyse){
                $repository['name'] =$analyse['repository'];
                foreach(json_decode($analyse['files']) as $file){
                    $repository['files'][] = $file;
                }
                if ($analyse['errorsFound'] == 0 && $analyse['securityFails'] == 0){
                    $repository['status'] = 'clean';
                }
                elseif ($analyse['errorsFound'] != 0 && $analyse['securityFails'] == 0){
                    $repository['status'] = 'warning';
                }
                else{
                    $repository['status'] = 'danger';
                }
                $repository['errorsFound'] = $analyse['errorsFound'];
                $repository['securityFails'] = $analyse['securityFails'];
                $repository['scannedFiles'] = $analyse['scannedFiles'];
                $repository['numberOfScans'] = $analyse['numberOfScans'];
                $repository['totalScannedFiles'] = ($analyse['scannedFiles'] * $analyse['numberOfScans']);
                $list[] = $repository;
            }
            return ['response' => 'success', 'code' => 200, 'data' => $list];
        } catch (Exeption $e){
            return ['response' => 'error', 'code' => $e->getCode(), 'message' => $e->getMessage()];
        }
    }
}
