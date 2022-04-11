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
        <h1>Result</h1>
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
                <option value="Minggu" @if($r == 'Minggu') selected @endif>Per Minggu</option>
                <option value="Bulan" @if($r == 'Bulan') selected @endif>Per Bulan</option>
                <option value="Tahun" @if($r == 'Tahun') selected @endif>Per Tahun</option>
              </select>

              <label class="mt-4" for="inputEmail4">Jenis Random</label>
              <select name="rand" class="form-control" readonly>
                <option value="reguler" @if($rand == 'reguler') selected @endif>Reguler Random</option>
                <option value="lgc" @if($rand == 'lgc') selected @endif>LGC Random</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Jumlah Taksiran/Ramalan</label>
              <div class="col-sm-12 p-0">
                <input type="number" min="1" name="jumlah" value="{{$j}}"  step="1" readonly/>
              </div>
            </div>
            <input type="file" name="csv" id="file-csv" hidden>
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
                <th scope="col" class="text-center">{{$r}} ke-</th>
                <th scope="col" class="text-center">Frekuensi</th>
                <th scope="col" class="text-center">Probabilitas</th>
                <th scope="col" class="text-center">Prob. Komulatif</th>
                <th scope="col" class="text-center">Batas Bawah</th>
                <th scope="col" class="text-center">Batas Atas</th>
                <th scope="col" class="text-center">Rentang Prob.</th>
              </tr>
            </thead>
            <tbody id="tbody">
              @foreach ($final_res['frekuensi'] as $key => $f)
              <tr>
                <td class="text-center" scope="row">{{$key+1}}</td>
                <td class="text-center">{{$f}}</td>
                <td class="text-center">{{number_format($final_res['probabilitas'][$key], 3, '.', '')}}</td>
                <td class="text-center">
                  @if($loop->last)
                  {{$final_res['komulatif'][$key]}}
                  @else
                  {{number_format($final_res['komulatif'][$key], 3, '.', '')}}
                  @endif
                </td>
                <td class="text-center">
                  @if ($loop->first)
                  {{$final_res['batas_bawah'][$key]}}
                  @else
                  {{number_format($final_res['batas_bawah'][$key], 3, '.', '')}}
                  @endif
                </td>
                <td class="text-center">
                  @if($loop->last)
                  {{$final_res['batas_atas'][$key]}}
                  @else
                  {{number_format($final_res['batas_atas'][$key], 3, '.', '')}}
                  @endif
              </td>
                <td class="text-center">
                @if ($loop->first)
                {{$final_res['batas_bawah'][$key] . ' <= x < '.number_format((float)$final_res['batas_atas'][$key], 3, '.', '')}}
                @elseif($loop->last)
                {{number_format((float)$final_res['batas_bawah'][$key], 3, '.', '') . ' < x <= '.$final_res['batas_atas'][$key]}}
                @else
                {{number_format((float)$final_res['batas_bawah'][$key], 3, '.', '') . ' < x <= '.number_format((float)$final_res['batas_atas'][$key], 3, '.', '')}}
                @endif
                </td>
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
              @foreach ($final_res['hasil'] as $key => $h)
              <tr>
                <td class="text-center" scope="row">{{$key+1}}</td>
                <td class="text-center">{{$final_res['angka_acak'][$key]}}</td>
                <td class="text-center">
                  @if ($final_res['hasil_index'][$key] == 0)
                  {{$final_res['batas_bawah'][$final_res['hasil_index'][$key]] . ' <= x < '.number_format((float)$final_res['batas_atas'][$final_res['hasil_index'][$key]], 3, '.', '')}}
                  @elseif($final_res['hasil_index'][$key] == count($final_res['frekuensi'])-1)
                  {{number_format((float)$final_res['batas_bawah'][$final_res['hasil_index'][$key]], 3, '.', '') . ' < x <= '.$final_res['batas_atas'][$final_res['hasil_index'][$key]]}}
                  @else
                  {{number_format((float)$final_res['batas_bawah'][$final_res['hasil_index'][$key]], 3, '.', '') . ' < x <= '.number_format((float)$final_res['batas_atas'][$final_res['hasil_index'][$key]], 3, '.', '')}}
                  @endif</td>
                <td class="text-center">{{$h}}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div> 

      <div class="card">
        <div class="card-header">Grafik Taksiran/Ramalan</div>
        <div class="card-body"><div class="chartjs-size-monitor" style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>
                    <canvas id="myChart2" style="display: block; height: 172px; width: 344px;" width="430" height="215" class="chartjs-render-monitor"></canvas>
                  </div>
      </div> 

      
      <div class="align-items-center text-center buttons">
          <button id="csv-download" class="btn btn-info"><i class="fas fa-file-download"></i> Download</button>
          <button type="button" class="btn btn-icon icon-left btn-primary store"><i class="fas fa-save"></i> @if(Auth::check()) Save @else Login for Save @endif</i></button>
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
    type: 'bar',
    data: {
      labels: d_tks,
      datasets: [{
        label: 'Frekuensi',
        data: hsl,
        borderWidth: 2,
        backgroundColor: '#6777ef',
        borderColor: '#6777ef',
        borderWidth: 2.5,
        pointBackgroundColor: '#ffffff',
        pointRadius: 4
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

  function download_csv(csv, filename) {
    var csvFile;
    var downloadLink;

    // CSV FILE
    csvFile = new Blob([csv], {type: "text/csv"});

    // Download link
    downloadLink = document.createElement("a");

    // File name
    downloadLink.download = filename;

    // We have to create a link to the file
    downloadLink.href = window.URL.createObjectURL(csvFile);

    // Make sure that the link is not displayed
    downloadLink.style.display = "none";

    // Add the link to your DOM
    document.body.appendChild(downloadLink);

    // Lanzamos
    downloadLink.click();
  }

  function export_table_to_csv(filename) {
    var csv = [];
    var rows = document.querySelectorAll("#tabel-perhit tr");
    var rows2 = document.querySelectorAll("#tabel-hasil tr");
    
      for (var i = 0; i < rows.length; i++) {
      var row = [], cols = rows[i].querySelectorAll("td, th");
      
          for (var j = 0; j < cols.length; j++) 
              row.push(cols[j].innerText);
          
      csv.push(row.join(","));		
      }

      csv.push('');

      for (var i = 0; i < rows2.length; i++) {
        var row = [],cols2 = rows2[i].querySelectorAll("td, th");
      
          for (var j = 0; j < cols2.length; j++) 
              row.push(cols2[j].innerText);
          
      csv.push(row.join(","));		
      }

    download_csv(csv.join("\n"), filename);
  }

  $('#csv-download').click(function (e) { 
    e.preventDefault();
    export_table_to_csv("ResultMontecarlo.csv");
  });

  function fromtable(filename) {
    var csv = [];
    var rows = document.querySelectorAll("#tabel-perhit tr");
    var rows2 = document.querySelectorAll("#tabel-hasil tr");
    let container = new DataTransfer();
    let fileInputElement = document.getElementById('file-csv');
    
      for (var i = 0; i < rows.length; i++) {
      var row = [], cols = rows[i].querySelectorAll("td, th");
      
          for (var j = 0; j < cols.length; j++) 
              row.push(cols[j].innerText);
          
      csv.push(row.join(","));		
      }

      csv.push('');

      for (var i = 0; i < rows2.length; i++) {
        var row = [],cols2 = rows2[i].querySelectorAll("td, th");
      
          for (var j = 0; j < cols2.length; j++) 
              row.push(cols2[j].innerText);
          
      csv.push(row.join(","));		
      }

      let csvBlob = new Blob([csv.join("\n")],{type: "text/csv"});
      let csvFile = new File([csvBlob], filename,{type: "text/csv",lastModified:new Date().getTime()});
      container.items.add(csvFile);
      fileInputElement.files = container.files;
  }

  $('.store').click(function (e) { 
    e.preventDefault();
    fromtable("ResultMontecarlo.csv");
    var form = $('#store-form');
    form.submit();
  });
  
  </script>
@endsection