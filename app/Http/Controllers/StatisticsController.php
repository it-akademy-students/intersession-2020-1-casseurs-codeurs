<?php

namespace App\Http\Controllers;

use App\Models\AnalyseModel;
use App\Models\Statistic;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function totalPerUser(int $id){
        try{
            $analyses = AnalyseModel::where([
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
            $total['lastRepository'] = end($analyses)['repository'];
            return ['response' => 'success', 'code' => 200, 'data' => $total];
        } catch (Exeption $e){
            return ['response' => 'error', 'code' => $e->getCode(), 'message' => $e->getMessage()];
        }
    }

    public function repositoryPerUser(int $id){
        try{
            $analyses = AnalyseModel::where([
                ['user_id', '=', $id ],
            ])->get()->toArray();
            $list = [];
            foreach ($analyses as $analyse){
                $repository = [];
                $repository['name'] =$analyse['repository'];
                foreach(json_decode($analyse['files']) as $file){
                    $filename = explode("\\",$file);
                    $filename = end($filename);
                    $search = str_replace('/', '_',$analyse['repository']);
                    $filename = explode($search,$filename);
                    $filename = end($filename);
                    $repository['files'][] = ['fileName' => $filename, 'path' => $file];
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

    public function generalStatistics(){
        try{
            return ['response' => 'success', 'code' => 200, 'data' => Statistic::first()->toArray()];
        } catch (Exeption $e){
            return ['response' => 'error', 'code' => $e->getCode(), 'message' => $e->getMessage()];
        }
    }
}
