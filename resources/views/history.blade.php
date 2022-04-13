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
        <h1>History</h1>
    </div>
    <div class="section-body">
      
      <div class="card">
        <div class="card-body">
          <table id="tabel" class="table table-bordered">
            <thead>
              <tr>
                <th scope="col" class="text-center">Created at</th>
                <th scope="col" class="text-center">Jumlah Taksiran</th>
                <th scope="col" class="text-center">Range</th>
                <th scope="col" class="text-center">Random</th>
                <th scope="col" class="text-center">Action</th>
              </tr>
            </thead>
            <tbody id="tbody">
              @foreach ($data as $d)
              <tr>  
                <td class="align-middle">{{$d->created_at}}</td>
                <td class="align-middle">{{$d->jumlah}}</td>
                <td class="align-middle">{{$d->range}}</td>
                <td class="align-middle">{{Str::upper($d->random)}} RANDOM</td>
                <td class="align-middle">
                  <div class="btn-toolbar justify-content-center" role="group">
                    <a href="{{ asset('result-file/'.$d->csvfile) }}" class="btn btn-icon btn-info mr-1" data-toggle="tooltip" data-placement="top" data-original-title="Download CSV" download><i class="fas fa-file-download"></i></a>
                    <a href="{{ route('view-data', [$d->uniq_id]) }}" class="btn btn-icon btn-primary" data-toggle="tooltip" data-placement="top" data-original-title="View"><i class="fas fa-eye"></i></a>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>    
    </div>
  </section>
</div>
@endsection

@section('scriptlib')
<script src="{{ asset('assets/modules/datatables/datatables.min.js') }} "></script>
<script src="{{ asset('assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }} "></script>
@endsection

@section('scriptline')
  <script>
    $("#tabel").DataTable(); 
  </script>
@endsection