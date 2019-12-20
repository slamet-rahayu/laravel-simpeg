@extends('simpeg.index')
@section('main')
<div class="col-lg-12" align="center" style="margin-top:20%; margin-bottom:40%;"><h3 class="font-weight-bold">App Kepegawaian</h3>
<br>
<h4 style="">Versi 1.0.0</h4></div><br>
<div class="row">
        <div class="col">
            <h3 align="center" class="font-weight-bold">Our Team</h3><br>
        </div>
    </div>
    <br><center>
<div class="row">
<div class="col-md-4 grid-margin stretch-card">
    <div class="card" style="width: 18rem; border-radius:3%;">
        <div class="card-header font-weight-bold">
            Slamet Rahayu
        </div>
    <img src="{{asset('images/person.jpg')}}" class="card-img-top" alt="...">
        <div class="card-body bg-dark"><center>
                <button type="button" class="btn btn-social-icon btn-outline-facebook"><i class="ti-facebook"></i></button>
                <button type="button" class="btn btn-social-icon btn-outline-youtube"><i class="ti-youtube"></i></button>
                <button type="button" class="btn btn-social-icon btn-outline-google"><i class="ti-google"></i></button>
        </center></div>
      </div>
</div>
<div class="col-md-4 grid-margin stretch-card">
    <div class="card" style="width: 18rem; border-radius:3%;">
        <div class="card-header font-weight-bold">
            Khilmi Aminuddin
        </div>
    <img src="{{asset('images/person.jpg')}}" class="card-img-top" alt="...">
        <div class="card-body bg-dark"><center>
                <button type="button" class="btn btn-social-icon btn-outline-facebook"><i class="ti-facebook"></i></button>
                <button type="button" class="btn btn-social-icon btn-outline-youtube"><i class="ti-youtube"></i></button>
                <button type="button" class="btn btn-social-icon btn-outline-google"><i class="ti-google"></i></button>
        </center></div>
      </div>
</div>
<div class="col-md-4 grid-margin stretch-card">
    <div class="card" style="width: 18rem; border-radius:3%;">
        <div class="card-header font-weight-bold">
            Zulkifly Raihan
        </div>
    <img src="{{asset('images/person.jpg')}}" class="card-img-top" alt="...">
        <div class="card-body bg-dark"><center>
                <button type="button" class="btn btn-social-icon btn-outline-facebook"><i class="ti-facebook"></i></button>
                <button type="button" class="btn btn-social-icon btn-outline-youtube"><i class="ti-youtube"></i></button>
                <button type="button" class="btn btn-social-icon btn-outline-google"><i class="ti-google"></i></button>
        </center></div>
      </div>
</div>
</div></center><br>
@endsection