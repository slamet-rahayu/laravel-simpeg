@php
    $pegawai = App\Pegawai::all();
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
  <title>Regitser User SIMPEG Tahfidz Preneur YBMPLN</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('base/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{url('images/favicon.ico')}}" />
</head>

<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper full-page-wrapper">
          <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
              <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                  <div class="brand-logo">
                    <img src="{{asset('images/Petik_YBM1.png')}}" alt="logo">
                  </div><br>
                  <h4>Registrasi User</h4>
                  <h6 class="font-weight-light"></h6>
                  <form class="pt-3" method="POST" action="{{ route('user.store') }}">
                    @csrf

                    <div class="form-group">
                        <select class="form-control form-control-lg @error('name') is-invalid @enderror synch" id="name" name="name" style="color: black;">
                          <option>-----Nama Pegawai-----</option>
                          @foreach ($pegawai as $peg)
                          <option value="{{$peg->nama_pegawai}}">{{$peg->nama_pegawai}}</option>                   
                          @endforeach
                        </select>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>
                    <div class="form-group">
                    <select name="email" type="email" class="form-control form-control-lg @error('email') is-invalid @enderror synch" id="email" style="color: black;">
                      <option>-----E-mail------</option>
                      @foreach ($pegawai as $peg)
                      <option value="{{$peg->email}}">{{$peg->email}}</option>                   
                      @endforeach
                    </select>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                    </div>
                    <div class="form-group">
                      <input type="password" id="password" class="form-control form-control-lg @error('password') is-invalid @enderror" name="password" placeholder="Password" required autocomplete="new-password">
                      @error('password')
                           <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                          </span>
                      @enderror
                    </div>
                    <div class="form-group">
                        <input type="password" name="password_confirmation" class="form-control form-control-lg" id="password-confirm" placeholder="Konfirmasi Password" required autocomplete="new-password">
                      </div>
                    {{-- <div class="mb-4">
                      <div class="form-check">
                        <label class="form-check-label text-muted">
                          <input type="checkbox" class="form-check-input">
                          I agree to all Terms & Conditions
                        </label>
                      </div>
                    </div> --}}
                    <div class="mt-3">
                      <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Daftar</button>
                    </div>
                    <div class="text-center mt-4 font-weight-light">
                    Sudah punya akun? <a href="{{url('/')}}" class="text-primary">Login</a>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
        </div>
        <!-- page-body-wrapper ends -->
      </div>
  <script src="{{asset('base/vendor.bundle.base.js')}}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <script src="{{asset('chart.js/Chart.min.js')}}"></script>
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{asset('js/off-canvas.js')}}"></script>
  <script src="{{asset('js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('js/template.js')}}"></script>
  <script src="{{asset('js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('js/dashboard.js')}}"></script>
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script> --}}
  <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
  <!-- End custom js for this page-->
  <script>
  var $synch = $(".synch").on('change', function() {
  $synch.not(this).get(0).selectedIndex = this.selectedIndex;
});
  </script>
</body>

</html>
