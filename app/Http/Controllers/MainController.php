<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index(){
        $f = [18,11,15,12,21];

        $prob = $this->probabilitas($f);

        $prob_kom = $this->probabilitas_komulatif($prob);

        $batas = $this->batas($prob_kom);

        $bil = $this->acak(4);

        $prediksi = $this->check_prediksi($f,$batas[0],$batas[1],$bil);

        $table = [
            'frekuensi' => $f,
            'probabilitas' => $prob,
            'komulatif' => $prob_kom,
            'batas bawah' => $batas[0],
            'batas atas' => $batas[1],
            'Angka acak' => $bil,
            'Hasil' => $prediksi
        ];

        dd( $table );
    }

    public function index2(){
        $title = 'Home';
        return view('app', compact('title'));
    }


    function sum($array){
        // $div = count($array);

        $total = 0;
        foreach ($array as $a){
            $total += $a;
        }

        return $total;
    }

    function probabilitas($array) {
        $p = [];

        $s = $this->sum($array);
        foreach($array as $a){
            $d = $a / $s;
            array_push($p, $d);
        }

        return $p;
    }

    function probabilitas_komulatif($prob) {
        $p = [];

        $b = 0;
        foreach($prob as $a){
            $b += $a;
            array_push($p, $b);
        }

        return $p;
    }

    function batas($pk){
        $bb = [0];
        $ba = $pk;

        for ($x = 0; $x <= count($pk)-2; $x++) {
            array_push($bb, $pk[$x]);
        }

        return [$bb,$ba];

    }

    function acak($banyak){
        $bil = [];

        for ($x = 0; $x <= $banyak; $x++) {
            array_push($bil, $this->rand_float());
        }

        return $bil;
    }

    function rand_float($st_num=0,$end_num=1,$mul=1000000){       
        if ($st_num>$end_num) return false;
        return mt_rand($st_num*$mul,$end_num*$mul)/$mul;
    }

    function random_lcg($min,$max) {
        return ($min+lcg_value()*(abs($max-$min)));
    }

    function check_prediksi($frekuensi, $batasbawah, $batasatas, $acak){
        $hasil = [];

        foreach($acak as $a){
            if ($a >= $batasbawah[0] && $a <= $batasatas[0]){
                // $hasil = $frekuensi[0];
                array_push($hasil,$frekuensi[0]);
            } else {
                for ($x = 1; $x <= count($frekuensi); $x++){
                    if ($a > $batasbawah[$x] && $a <= $batasatas[$x]){
                        // $hasil = $frekuensi[$x];
                        array_push($hasil,$frekuensi[$x]);
                        break;
                    }
                }
            }
        }

        return $hasil;
    }
}
