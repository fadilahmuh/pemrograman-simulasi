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
          <button id="modal-2" class="btn btn-icon icon-left btn-primary">Mulai Simulasi <i class="fas fa-angle-right"></i></button>
      </div>
    </div>
  </section>
</div>
@endsection
