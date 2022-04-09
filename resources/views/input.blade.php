@extends('app')

@section('maincontent')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
        <h1>Manual Input</h1>
    </div>
    <form action="{{ route('manual-result') }}" method="POST">
      @csrf
      @method('POST')
    
    <div class="section-body">
      <h2 class="section-title">Setting</h2>
      <div class="card">
        <div class="card-body">
          <div class="row">
            <div class="form-group col-md-6">
              <label for="inputEmail4">Range Data Frekuensi</label>
              <select name="range" class="form-control">
                <option value="Minggu" selected>Per Minggu</option>
                <option value="Bulan">Per Bulan</option>
                <option value="Tahun">Per Tahun</option>
              </select>

              <label class="mt-4" for="inputEmail4">Jenis Random</label>
              <select name="rand" class="form-control">
                <option value="reguler" selected>Reguler Random</option>
                <option value="lgc">LGC Random</option>
              </select>
            </div>
            <div class="form-group col-md-6">
              <label for="inputEmail4">Jumlah Taksiran/Ramalan</label>
              <div class="col-sm-12 p-0">
                <input type="number" min="1" name="jumlah" value="1"  step="1"/>
              </div>
            </div>
          </div>
        </div>
      </div>    

      <h2 class="section-title">Data Frekuensi</h2>
      
      <div class="card">
        <div class="card-body">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th id="dat-ran" scope="col" class="text-center">Minggu ke-</th>
                <th scope="col" class="text-center">Frekuensi</th>
                <th scope="col" class="text-center">#</th>
              </tr>
            </thead>
            <tbody id="tbody">

            </tbody>
            <tfoot>
              <tr>
                <td class="text-center" scope="row">x</td>
                <td class="text-center">
                  <input id="input-f" type="text" class="form-control">
                </td>
                <td class="text-center">
                  <button id="addBtn" class="btn btn-success">Add</button>
                </td>
              </tr>
            </tfoot>
          </table>
        </div>
      </div> 
      <div class="align-items-center text-center">
          <button type="submit" class="btn btn-icon icon-left btn-primary">Submit <i class="fas fa-angle-right"></i></button>
      </div>
    </div>
  </form>
  </section>
</div>
@endsection

@section('scriptlib')
<script src="{{ asset('assets/modules/bootstrap-input-spinner/src/bootstrap-input-spinner.js') }}"></script>
@endsection

@section('scriptline')
  <script>
  $("input[type='number']").inputSpinner();

  var rowIdx = 0;
  
  // jQuery button click event to add a row.
  $('#addBtn').on('click', function (e) {
    e.preventDefault();

    $d = $('#input-f').val();
    // console.log($d);
    $('#input-f').val("");
    
    
      // Adding a row inside the tbody.
      $('#tbody').append(`<tr id="R${++rowIdx}">
          <td class="row-index text-center" scope="row"><p>${rowIdx}</p></td>
          <td class="text-center"><input name="frequensi[]" type="text" class="form-control" value="`+$d+`"></td>
          <td class="text-center col-2">
            <button class="btn btn-danger remove">Delete</button>
          </td>
        </tr>`);

    $('#input-f').focus();
        
  });

  $('#tbody').on('click', '.remove', function () {
  
  // Getting all the rows next to the 
  // row containing the clicked button
  var child = $(this).closest('tr').nextAll();

  // Iterating across all the rows 
  // obtained to change the index
  child.each(function () {
        
      // Getting <tr> id.
      var id = $(this).attr('id');

      // Getting the <p> inside the .row-index class.
      var idx = $(this).children('.row-index').children('p');

      // Gets the row number from <tr> id.
      var dig = parseInt(id.substring(1));

      // Modifying row index.
      idx.html(`${dig - 1}`);

      // Modifying row id.
      $(this).attr('id', `R${dig - 1}`);
  });

  // Removing the current row.
  $(this).closest('tr').remove();

  // Decreasing the total number of rows by 1.
  rowIdx--;
});
  </script>
@endsection