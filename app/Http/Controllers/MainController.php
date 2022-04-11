<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\MockObject\Stub\ReturnSelf;

class MainController extends Controller
{
    public function index(){
        $title = 'Home';
        return view('home', compact('title'));
    }

    public function input(){
        $title = 'Manual Input';

        return view('input', compact('title'));
    }

    public function import(){
        $title = 'Import Data';

        return view('import', compact('title'));
    }

    public function history()
    {
        $title = 'History';

        $data = Data::where('users_id', Auth::user()->id)->get();
        return view('history', compact('title','data'));
    }

    public function read_csv(Request $request){
        $result = [];
        $row = 1;
        $file_handle = fopen($request->csvload, 'r');
        while (($data = fgetcsv($file_handle, 0, ",")) !== FALSE) {
            $num = count($data);
            $row++;
            for ($c=0; $c < $num; $c++) {
                array_push($result, $data[$c]);
            }
        }
        fclose($file_handle);
        // dd($result);
        $view =  view('table-import', compact('result'))->render();

        return response(['table' => $view]); 
    }

    public function result(Request $request){
        // dd($request->all());
        $request->all();

        $f = $request->frequensi;
        $j = (int)$request->jumlah;
        $r = $request->range;
        $rand = $request->rand;

        // dd($f, $j, $r, $rand);
        $final_res = $this->montecarlo($f, $j, $rand);

        // dd($final_res);

        $title = 'Result';
        return view('result', compact('title','r','j','rand','final_res'));
    }

    private function montecarlo($frekuensi, $jumlah, $rand){

        $prob = $this->probabilitas($frekuensi);

        $prob_kom = $this->probabilitas_komulatif($prob);

        $batas = $this->batas($prob_kom);

        if($rand = 'reguler'){
            $bil = $this->acak($jumlah);
        } elseif($rand = 'lgc'){
            $bil = $this->random_lcg($jumlah);
        }

        $prediksi = $this->check_prediksi($frekuensi,$batas[0],$batas[1],$bil);

        $table = [
            'frekuensi' => $frekuensi,
            'probabilitas' => $prob,
            'komulatif' => $prob_kom,
            'batas_bawah' => $batas[0],
            'batas_atas' => $batas[1],
            'angka_acak' => $bil,
            'hasil' => $prediksi[0],
            'hasil_index' =>$prediksi[1],
        ];

        return $table;
    }

    public function index2(){
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

        for ($x = 0; $x < $banyak; $x++) {
            array_push($bil, $this->rand_float());
        }

        return $bil;
    }

    function rand_float($st_num=0,$end_num=1,$mul=1000000){       
        if ($st_num>$end_num) return false;
        return mt_rand($st_num*$mul,$end_num*$mul)/$mul;
    }

    function random_lcg($banyak) {
        $bil = [];

        for ($x = 0; $x < $banyak; $x++) {
            array_push($bil,(0+lcg_value()*(abs(1-0))));
        }

        return $bil;
    }

    function check_prediksi($frekuensi, $batasbawah, $batasatas, $acak){
        $hasil = [];
        $index = [];

        foreach($acak as $a){
            if ($a >= $batasbawah[0] && $a <= $batasatas[0]){
                // $hasil = $frekuensi[0];
                array_push($hasil,$frekuensi[0]);
                array_push($index,0);
            } else {
                for ($x = 1; $x <= count($frekuensi); $x++){
                    if ($a > $batasbawah[$x] && $a <= $batasatas[$x]){
                        // $hasil = $frekuensi[$x];
                        array_push($hasil,$frekuensi[$x]);
                        array_push($index,$x);
                        break;
                    }
                }
            }
        }

        return [$hasil,$index];
    }
}
