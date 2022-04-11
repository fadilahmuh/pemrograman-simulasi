<h2 class="section-title">Data Frekuensi</h2>
      
<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
        <thead>
            <tr>
            <th id="dat-ran" scope="col" class="text-center"><p id="range-txt" class="d-inline">Minggu</p> ke-</th>
            <th scope="col" class="text-center">Frekuensi</th>
            <th scope="col" class="text-center">#</th>
            </tr>
        </thead>
        <tbody id="tbody">
            @foreach($result as $key => $r)  
            <tr id="R{{$key+1}}">
                <td class="row-index text-center" scope="row"><p>{{$key+1}}</p></td>
                <td class="text-center"><input name="frequensi[]" type="text" class="form-control" value="{{$r}}"></td>
                <td class="text-center col-2">
                  <button class="btn btn-danger remove">Delete</button>
                </td>
              </tr>
            @endforeach

        </tbody>
        </table>
    </div>
</div>

<script>
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

  });
</script>