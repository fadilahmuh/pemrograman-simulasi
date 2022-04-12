@extends('app')

@section('csslib')
<link rel="stylesheet" href="{{ asset('assets/modules/datatables/datatables.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css') }}">
@endsection

@section('maincontent')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
        <h1>History Data</h1>
    </div>    
    <div class="section-body">  
      <div class="card">
        <div class="card-body">
          <form id="store-form" action="{{ route('data.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
          <div class="row">
            <div class="form-group col-md-6">              
              <label for="inputEmail4">Range Data Frekuensi</label>
              <select name="range" class="form-control" readonly>
                <option value="Minggu" @if($data_his->range == 'Minggu') selected @endif>Per Minggu</option>
                <option value="Bulan" @if($data_his->range == 'Bulan') selected @endif>Per Bulan</option>
                <option value="Tahun" @if($data_his->range == 'Tahun') selected @endif>Per Tahun</option>
              </select>

              <label class="mt-4" for="inputEmail4">Jenis Random</label>
              <select name="rand" class="form-control" readonly>
                <option value="reguler" @if($data_his->random == 'reguler') selected @endif>Reguler Random</option>
                <option value="lgc" @if($data_his->random == 'lgc') selected @endif>LCG Random</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Jumlah Taksiran/Ramalan</label>
              <div class="col-sm-12 p-0">
                <input type="number" min="1" name="jumlah" value="{{$data_his->jumlah}}"  step="1" readonly/>
              </div>
            </div>
          </div>
        </form>
        </div>
      </div>  
      <div class="card">
        <div class="card-header">Tabel Pehitungan</div>
        <div class="card-body">
          <table id="tabel-perhit" class="table table-bordered">
            <thead>
              <tr>
                <th scope="col" class="text-center">{{$data_his->range}} ke-</th>
                <th scope="col" class="text-center">Frekuensi</th>
                <th scope="col" class="text-center">Probabilitas</th>
                <th scope="col" class="text-center">Prob. Komulatif</th>
                <th scope="col" class="text-center">Batas Bawah</th>
                <th scope="col" class="text-center">Batas Atas</th>
                <th scope="col" class="text-center">Rentang Prob.</th>
              </tr>
            </thead>
            <tbody id="tbody">
              @foreach ($input as $key => $a)
              <tr>
                <td class="text-center" scope="row">{{$input[$key][0]}}</td>
                <td class="text-center">{{$input[$key][1]}}</td>
                <td class="text-center">{{$input[$key][2]}}</td>
                <td class="text-center">{{$input[$key][3]}}</td>
                <td class="text-center">{{$input[$key][4]}}</td>
                <td class="text-center">{{$input[$key][5]}}</td>
                <td class="text-center">{{$input[$key][6]}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> 

      <div class="card">
        <div class="card-header">Tabel Taksiran/Ramalan</div>
        <div class="card-body">
          <table id="tabel-hasil" class="table table-bordered">
            <thead>
              <tr>
                <th id="dat-ran" scope="col" class="text-center">Taksiran ke-</th>
                <th scope="col" class="text-center">Nilai Acak</th>
                <th scope="col" class="text-center">Rentang Nilai</th>
                <th scope="col" class="text-center">Hasil</th>
              </tr>
            </thead>
            <tbody id="tbody">
              @foreach ($result as $key => $a)
              <tr>
                <td class="text-center" scope="row">{{$result[$key][0]}}</td>
                <td class="text-center">{{$result[$key][1]}}</td>
                <td class="text-center">{{$result[$key][2]}}
                <td class="text-center">{{$result[$key][3]}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
          <hr>
          <p class="lead mt-4">Jumlah Permintaan : {{$data_his->sum}}</p>
          <p class="lead mt-4">Rata-rata Permintaan Per {{$data_his->random}} :  {{$data_his->avg}} </p>
        </div>
      </div> 

      <div class="card">
        <div class="card-header">Grafik Taksiran/Ramalan</div>
        <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
          <canvas id="myChart2" style="display: block; height: 172px; width: 344px;" width="430" height="215" class="chartjs-render-monitor"></canvas>
        </div>
      </div> 

    </div>
  </section>
</div>
@endsection

@section('scriptlib')
<script src="{{ asset('assets/modules/bootstrap-input-spinner/src/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('assets/modules/chart.min.js') }} "></script>
<script src="{{ asset('assets/modules/datatables/datatables.min.js') }} "></script>
<script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }} "></script>
<script src="{{ asset('assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js') }} "></script>
<script src="{{ asset('assets/modules/jquery-ui/jquery-ui.min.js') }} "></script>
@endsection

@section('scriptline')
  <script>
  $("input[type='number']").inputSpinner();
  $(".btn-increment").prop("disabled", true);
  $(".btn-decrement").prop("disabled", true);

  var tab_res = $("#tabel-hasil").DataTable({
    iDisplayLength: -1,
    paging: false,
    "searching": false,
    "info": false
  });
  var tks = tab_res.column( 0 ).data().toArray();;
  var d_tks = [];
  tks.forEach(function(item,index){
    d_tks.push("Taksiran ke-"+item);
  });

  var hsl = tab_res.column( 3 ).data().toArray();;

  var ctx = document.getElementById("myChart2").getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: d_tks,
      datasets: [{
        label: 'Frekuensi',
        data: hsl,
        borderWidth: 2,
        borderColor: '#6777ef',
        borderWidth: 2.5,
        pointBackgroundColor: '#ffffff',
        pointRadius: 4,
        lineTension: 0
      }]
    },
    options: {
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          gridLines: {
            drawBorder: false,
            color: '#f2f2f2',
          },
          ticks: {
            beginAtZero: true,
          }
        }],
        xAxes: [{
          ticks: {
            display: false
          },
          gridLines: {
            display: false
          }
        }]
      },
    }
  });  
</script>
@endsection