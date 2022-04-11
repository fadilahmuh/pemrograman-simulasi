<?php

namespace App\Http\Controllers;

use App\Models\Data;
use App\Http\Requests\StoreDataRequest;
use App\Http\Requests\UpdateDataRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDataRequest $request)
    {
        // dd($request);
        // dd($this->generate_id(10));
        $uniq = $this->generate_id(10);
        Data::create([
            'users_id' => Auth::user()->id,
            'uniq_id' => $uniq,
            'range' => $request->range,
            'random' => $request->rand,
            'jumlah' => $request->jumlah,
            // 'content' => $request->A,
            'csvfile' => $uniq.'.'.$request->csv->getClientOriginalExtension()
        ]);
        $request->csv->move('result-file/', $uniq.'.'.$request->csv->getClientOriginalExtension());

        return redirect()->route('home')->with('success','Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function show(Data $data)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function edit(Data $data)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDataRequest  $request
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDataRequest $request, Data $data)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Data  $data
     * @return \Illuminate\Http\Response
     */
    public function destroy(Data $data)
    {
        //
    }

    public function view_data($uniq)
    {
        $data_his = Data::where('uniq_id',$uniq)->first();

        $input = [];
        $result = [];
        $row = 1;
        $file_handle = fopen(public_path('result-file/'.$data_his->csvfile), 'r');
        while (($data = fgetcsv($file_handle, 0, ",")) !== FALSE) {
            $num = count($data);
            $row++;
            if($num == 7){
                array_push($input,$data);
            } elseif ($num == 4){
                array_push($result,$data);
            }
            
        }
        fclose($file_handle);

        unset($input[0]);
        unset($result[0]);

        return view('view-data',compact('data_his','input','result'));
    }

    function generate_id($limit) {
        $key = substr(base_convert(sha1(uniqid(mt_rand())), 16, 36), 0, $limit);

        return $key;
    }
}
