@extends('app')

@section('maincontent')
<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
        <h1>Home</h1>
    </div>
      @if($errors->any())
        @foreach($errors->getMessages() as $this_error)
        <div class="alert alert-danger" role="alert">
          <i class="fas fa-exclamation-triangle  mr-3"></i> {{$this_error[0]}}
        </div> 
        @endforeach
      @endif 
      @if(Session::has('success'))
      <div class="alert alert-success" role="alert">
        <i class="fas fa-check mr-3"></i> {{ Session('success') }} 
      </div>        
      @endif
    <div class="section-body">
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('assets/img/21091.jpg') }}" alt="First slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('assets/img/3156691.jpg') }}" alt="Second slide">
                      </div>
                      <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('assets/img/3162813.jpg') }}" alt="Third slide">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          </div>
        </div>
      <h2 class="section-title">Pemrograman Simulasi</h2>
      
      <div class="card">
        <div class="card-body">
          <p class="lead mt-4">
            Pemrograman simulasi adalah suatu ilmu programming yang mempelajari tentang bagaimana memanipulasi sebuah model sedemikian rupa dari sebuah sistem nyata. Tujuan dari pemrograman simulasi adalah sebagai berikut :
          </p>
          <ol class="lead">
            <li>Untuk mempelajari perilaku sistem (behavior)</li>
            <li>Untuk pelatihan / training</li>
            <li>Untuk hiburan / permainan (game)</li>
          </ol>
        </div>
      </div>    

      <h2 class="section-title">Montecarlo</h2>
      
      <div class="card">
        <div class="card-body">
          <p class="lead mt-4">
            Metode montecarlo merupakan metode analisis numberik yang melibatkan pengambilan sampel eksperimen bilangan acak.
          </p>
          <p>- Djati (2007)</p>
          <hr>
          <p class="lead mt-4">
            Montecarlo adalah simulasi tipe probabilitas yang mendekati solusi sebuah masalah dengan melakukan sampling dari proses acak
          </p>
          <p>- Arifin (2009)</p>
        </div>
      </div> 
      <div class="align-items-center text-center">
          <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Mulai Simulasi <i class="fas fa-angle-right"></i></button>
      </div>
    </div>
  </section>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="exampleModal">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body p-4">
                <div class="row mt-4">
                  <div class="col-6 text-center align-middle">
                    <a href="{{ route('input') }}" class="btn btn-icon btn-lg btn-success"><i class="fas fa-table fa-5x" style="font-size: 2rem;"></i></a>
                    <p>Manual Input</p>
                  </div>
                  <div class="col-6 text-center align-middle">
                    <a href="{{ route('import') }}" class="btn btn-icon btn-lg btn-success"><i class="fas fa-file-csv fa-5x" style="font-size: 2rem;"></i></a>
                    {{-- <a href="{{ route('input') }}" class="btn btn-icon btn-lg btn-success"><i class="fas fa-file-csv fa-5x" style="font-size: 2rem;"></a> --}}
                    <p>CSV Import</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
@endsection

@section('scriptlib')
<script src="{{ asset('assets/modules/prism/prism.js') }} "></script>
@endsection