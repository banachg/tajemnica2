<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function calculate(Request $request)
    {
        $request->validate([
            'piki' => 'required|numeric|min:10|max:20000',
            'opcja' => 'required|in:123,23,234,1234',
        ]);

        $duration_exponent = 0.45;
        $duration_initial_seconds = 1800;
        $duration_factor = 0.683020128377197;
        $piki = $request->get('piki');
        $opcja = $request->get('opcja');
        $left_packs = 0;

        if($opcja == '234'){
            $toSend[4] = floor($piki*2/11);
            $toSend[3] = floor(($piki-$toSend[4])*3/9);
            $toSend[2] = $piki-$toSend[4]-$toSend[3];
            $toSend[1] = 0;
        }
        elseif($opcja == '1234'){
            $toSend[4] = floor($piki*2/26);
            $toSend[3] = floor(($piki-$toSend[4])*3/24);
            $toSend[2] = floor(($piki-$toSend[4]-$toSend[3])*6/21);
            $toSend[1] = $piki-$toSend[4]-$toSend[3]-$toSend[2];
        }
        elseif($opcja == '123'){
            $toSend[4] = 0;
            $toSend[3] = floor($piki*3/24);
            $toSend[2] = floor(($piki-$toSend[3])*6/21);
            $toSend[1] = $piki-$toSend[3]-$toSend[2];
        }
        elseif($opcja == '23'){
            $toSend[4] = 0;
            $toSend[3] = floor($piki*3/9);
            $toSend[2] = $piki-$toSend[3];
            $toSend[1] = 0;
        }

        $czas[1] = $toSend[1] ? round((pow((pow($toSend[1]*25,2)*100*pow(0.1, 2)), $duration_exponent)+$duration_initial_seconds)*$duration_factor) : 0;
        $czas[2] = $toSend[2] ? round((pow((pow($toSend[2]*25,2)*100*pow(0.25, 2)), $duration_exponent)+$duration_initial_seconds)*$duration_factor) : 0;
        $czas[3] = $toSend[3] ? round((pow((pow($toSend[3]*25,2)*100*pow(0.5, 2)), $duration_exponent)+$duration_initial_seconds)*$duration_factor) : 0;
        $czas[4] = $toSend[4] ? round((pow((pow($toSend[4]*25,2)*100*pow(0.75, 2)), $duration_exponent)+$duration_initial_seconds)*$duration_factor) : 0;

        $zebrane[1] = $toSend[1] ? round($toSend[1]*25*0.1) : 0;
        $zebrane[2] = $toSend[2] ? round($toSend[2]*25*0.25) : 0;
        $zebrane[3] = $toSend[3] ? round($toSend[3]*25*0.5) : 0;
        $zebrane[4] = $toSend[4] ? round($toSend[4]*25*0.75) : 0;

        $godzinowo[1] = $toSend[1] ? round($zebrane[1]/$czas[1]*3600) : 0;
        $godzinowo[2] = $toSend[2] ? round($zebrane[2]/$czas[2]*3600) : 0;
        $godzinowo[3] = $toSend[3] ? round($zebrane[3]/$czas[3]*3600) : 0;
        $godzinowo[4] = $toSend[4] ? round($zebrane[4]/$czas[4]*3600) : 0;

        $naGodzine = $godzinowo[1]+$godzinowo[2]+$godzinowo[3]+$godzinowo[4];
        $lacznie = $zebrane[1]+$zebrane[2]+$zebrane[3]+$zebrane[4];
        $dlugosc = gmdate("H:i:s", max($czas));


        return response()->json(['czas' => $dlugosc, 'naGodzine' => $naGodzine, 'lacznie' => $lacznie]);
    }
}
