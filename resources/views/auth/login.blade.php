<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=yes">
  <title>Login SIMPEG Tahfidz Preneur YBMPLN</title>
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
          <div class="col-lg-4 col-md-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <h4 align="center" style="margin: auto 10px;">LOGIN</h4><hr>
              <div class="brand-logo">
                <img src="{{asset('images/Petik_YBM1.png')}}">
              </div><br>
              <!-- <h4 align="center">Selamat Datang</h4><br> -->
              <h6 class="font-weight-light">Masuk untuk melanjutkan</h6>
              <form class="pt-3" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                  <!-- <label for="email" class="col-form-label text-md-right">{{ __('E-Mail Address') }}</label> -->
                  <input type="email" class="form-control form-control-md @error('email') is-invalid @enderror" id="exampleInputEmail1" placeholder="Email" name="email"
                  value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>

                <div class="form-group">
                 <!--  <label for="password" class="col-form-label text-md-right">{{ __('Password') }}</label> -->
                  <input type="password" class="form-control form-control-md @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password" name="password"
                  required autocomplete="current-password">
                  @error('password')
                  <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
                <div class="mt-3">
                  <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit">{{ __('Login') }}</button>

                </div>
                <div class="my-2 d-flex justify-content-between align-items-center">
{{--                   <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      Keep me signed in
                    </label>
                  </div>
                  <a href="#" class="auth-link text-black">Forgot password?</a>
                </div>
                <div class="mb-2">
                  <button type="button" class="btn btn-block btn-facebook auth-form-btn">
                    <i class="ti-facebook mr-2"></i>Connect using facebook
                  </button>
                </div> --}}
                <div class="text-center mt-4 font-weight-light">
                Belum memiliki akun? <a href="{{route('user.create')}}" class="text-primary">Buat akun baru</a>
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
  <!-- End custom js for this page-->
</body>

</html>
