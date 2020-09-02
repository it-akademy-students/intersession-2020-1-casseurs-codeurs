<?php

namespace App\Http\Controllers;

use App\Analyse;
use Illuminate\Http\Request;

class StatisticsController extends Controller
{
    public function totalPerUser(int $id){
        $analyses = Analyse::where([
            ['user_id', '=', $id ],
        ])->get()->toArray();
        $total = [];
        foreach ($analyses as $analyse){
            $total['scannedFiles'] += $analyse['scannedFiles'];
            $total['numberOfScans'] += $analyse['numberOfScans'];
        }
        dd($analyses);
    }
}
