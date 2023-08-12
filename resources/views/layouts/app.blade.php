<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="./assets/img/favicon.png">
  <title>
    Siakad Polsub
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="{{ asset('css/nucleo-svg.css') }}" rel="stylesheet" />
  {{-- <link href='{{ asset('fonts/boxicons.min.css') }}' rel='stylesheet'> --}}
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" />

  @yield('css')
</head>

<body class="g-sidenav-show   bg-gray-100">
  <div class="min-height-300 bg-primary position-absolute w-100"></div>
  @if(Auth::guard('web')->user() || Auth::guard('orang_tua')->user())
  @include('layouts.sidebar')
  @endif
  <main class="main-content position-relative border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">{{ Request::path() }}</li>
          </ol>
          <h6 class="font-weight-bolder text-white mb-0 text-capitalize">{{Request::path()}}</h6>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">

          </div>
          @if(Auth::guard('orang_tua')->user() || Auth::guard('web')->user())
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <form id="logoutForm" action="{{route('logout')}}" method="post">
                @csrf
                <button class="nav-link text-white border-0 bg-transparent font-weight-bold px-0 logout-btn">
                  <i class="fa fa-user me-sm-1"></i>
                  @if (Auth::user())
                  <span class="d-sm-inline d-none">{{ Auth::user()->name }}</span>
                  @else
                  <span class="d-sm-inline d-none">{{ Auth::guard('orang_tua')->user()->name }}</span>
                  @endif
                </button>
              </form>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
            <li class="nav-item px-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0">
                <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
              </a>
            </li>
          </ul>
          @endif
        </div>
      </div>
    </nav>

    <div class="container-fluid {{ check_late() >= 100 ? '' : 'd-none' }}">
      <div class="alert alert-danger" style="color : #fff;" role="alert">
          <strong>Warning!</strong> Telat sudah mencapai {{ check_late() }} menit, jangan sampai telat lagi!
      </div>
    </div>
    
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        @yield('content')
        {{-- @include('layouts.footer') --}}
    </div>
  </main>
  <!--   Core JS Files   -->
  <script src="{{ asset('js/core/popper.min.js') }}"></script>
  <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
  <!-- Github buttons -->
  <script async defer src="{{ asset('https://buttons.github.io/buttons.js') }}"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('js/argon-dashboard.min.js?v=2.0.4') }}"></script>
  @if(Session::has('swal'))
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire(@json(Session::get('swal')));
            });
        </script>
    @endif
  @yield('js')
  <script>
    $(document).ready(function() {
        $('.logout-btn').on('click', function(event) {
            event.preventDefault(); // Prevent the default link behavior

            Swal.fire({
                title: 'Logout Confirmation',
                text: 'Are you sure you want to logout?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Logout',
            }).then((result) => {
                if (result.isConfirmed) {
                    $('#logoutForm').submit();
                }
            });
        });
    });
  </script>
</body>

</html>
