<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/') }}">
              <i class="ti-dashboard menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>
          <li class="nav-item">
              <a class="nav-link" href="{{ url('jabatan') }}">
                <i class="ti-briefcase menu-icon"></i>
                <span class="menu-title">Data Jabatan</span>
              </a>
            </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('bagian') }}">
              <i class="ti-bag menu-icon"></i>
              <span class="menu-title">Data Bagian</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/pegawai') }}">
              <i class="ti-id-badge menu-icon"></i>
              <span class="menu-title">Data Pegawai</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ url('/pendidikan') }}">
              <i class="ti-book menu-icon"></i>
              <span class="menu-title">Data Pendidikan</span>
            </a>
          </li>
          <li class="nav-item">
            @if (Auth::user()->role == 'admin')
            <a class="nav-link" href="{{ url('/gaji') }}">
            @else
            <a class="nav-link" href="{{route('gaji.show',Auth::user()->email)}}">
            @endif
                <i class="ti-money menu-icon"></i>
                <span class="menu-title">Data Gaji</span>
              </a>
            </li>
          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
              <i class="ti-user menu-icon"></i>
              <span class="menu-title">Manajemen User</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ url('user') }}"> Daftar User </a></li>
                @if (Auth::user()->role == 'admin')
                <li class="nav-item"> <a class="nav-link" href="{{ route('register') }}"> Registrasi User Baru </a></li>
                @endif
              </ul>
            </div>
          </li>
          <li class="nav-item">
          <a class="nav-link" href="{{url('about')}}">
              <i class="ti-write menu-icon"></i>
              <span class="menu-title">About</span>
            </a>
          </li>
        </ul>
      </nav>