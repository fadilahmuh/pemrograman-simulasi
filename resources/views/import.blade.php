@extends('app')

@section('csslib')
  <link rel="stylesheet" href="{{ asset('assets/modules/dropify/dist/css/dropify.css') }}">
@endsection

@section('maincontent')
<div class="main-content">
  <section class="section">
    <div class="section-header">
        <h1>CSV Import</h1>
    </div>

    <div class="section-body">
      <form id="csvtotable" action="{{ route('read') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
      <div class="card">
        <div class="card-body">
          <input id="csv-input" type="file" name="csvload" class="dropify" data-show-remove="false" data-height="300"  />
        </div>
        <div class="card-footer text-right">
          <button type="submit" id="importBtn" class="btn btn-primary">Process</button>
        </div>
      </div>
      </form>
    </div>
    
    <div class="section-body">
      <form action="{{ route('result') }}" method="POST">
        @csrf
        @method('POST') 

      <div id="result">

      </div>

      <h2 class="section-title">Setting</h2>

      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Range Data Frekuensi</label>
              <select id="input-range" name="range" class="form-control" disabled>
                <option value="Minggu" selected>Per Minggu</option>
                <option value="Bulan">Per Bulan</option>
                <option value="Tahun">Per Tahun</option>
              </select>
              <label class="mt-4" for="inputEmail4">Jenis Random</label>
              <select id="input-rand" name="rand" class="form-control" disabled>
                <option value="reguler" selected>Reguler Random</option>
                <option value="lgc">LCG Random</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Jumlah Taksiran/Ramalan</label>
              <div class="col-sm-12 p-0">
                <input id="input-jumlah" type="number" min="1" name="jumlah" value="1"  step="1" disabled/>
              </div>
            </div>
          </div>
        </div>
      </div>    
      <div class="align-items-center text-center">
          <button type="submit" class="btn btn-icon icon-left btn-primary">Submit <i class="fas fa-angle-right"></i></button>
      </div>
    </form>
    </div>
  </section>
</div>
@endsection

@section('scriptlib')
<script src="{{ asset('assets/modules/bootstrap-input-spinner/src/bootstrap-input-spinner.js') }}"></script>
<script src="{{ asset('assets/modules/dropify/dist/js/dropify.js') }}"></script>
<script src="{{ asset('assets/modules/papaparse/papaparse.js') }}"></script>
@endsection

@section('scriptline')
  <script>
  $("input[type='number']").inputSpinner();

  $('.dropify').dropify({
    messages: {
        'default': 'Tarik dan lepaskan file atau klik disini',
        'replace': 'Tarik dan lepaskan file atau klik disini untuk mengganti',
        'remove':  'Remove',
        'error':   'Ooops, kesalahan terjadi.'
    }
  }); 

  $("#input-range").on('change', function() {
  // alert( this.value );
    $('#range-txt').text(this.value);
  });

  $('#importBtn').click(function (e) { 
    e.preventDefault();
    
    var form = $('#csvtotable');
    // console.log(form.attr('action'));
    var formData = new FormData(document.getElementById("csvtotable"));
    
    $.ajax({
      type: "POST",
      url: form.attr('action'),
      data: formData,
      enctype: 'multipart/form-data',
      processData: false,
      contentType: false,
      cache: false,
      success: function (response) {
        // console.log(response.table);
        $("#result").html(response.table); 
        $("#input-range").prop( "disabled", false );
        $("#input-rand").prop( "disabled", false );
        $("#input-jumlah").prop( "disabled", false );
      }
    });
  });
  </script>
@endsection