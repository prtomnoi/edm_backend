@extends('layout')

@section('title', 'หน้าหลัก')

@section('content')
      <div class="container-fluid">
           <div class="row">
               <div class="col-md-4">
                  <div class="card" style="background-color:black; color:#ffffff;">
                    <div class="text-center h-100">
                      <img src="{{ URL::asset('assets/images/logos/edm-media2.png') }}" width="250px" alt="...">
                    </div>
                    <div class="card-body">
                      <h5 class="card-title text-white">EDM MEDIA</h5>
                      <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                      <a href="#" class="btn btn-primary">View  </a>
                    </div>
                  </div>
               </div>
               <div class="col-md-4">
                <div class="card " style="background-color:black; color:#ffffff;">
                  <div class="text-center mt-2">
                    <img src="{{ URL::asset('assets/images/logos/edm-management.png') }}" width="250px"  alt="...">
                  </div>
                  <div class="card-body">
                    <h5 class="card-title text-white">EDM MANAGEMENT</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">View</a>
                  </div>
                </div>
             </div>
           </div>
      </div>
  
  @endsection