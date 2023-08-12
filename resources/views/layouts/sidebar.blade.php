<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="/ " target="_blank">
        <img src="{{ asset('/img/logo-polsub.png') }}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Akademik Polsub</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse sidebar-height" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{ Request::path() == 'dashboard' ? 'active' : '' }}" href="/dashboard">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        @if (Auth::user())
            @if (Auth::user()->role->role_name == 'admin jurusan')
            <li class="nav-item">
                <a class="nav-link {{ Request::path() == 'kelas' ? 'active' : '' }}" href="/kelas">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-users text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Kelas</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::path() == 'mata-kuliah' ? 'active' : '' }}" href="/mata-kuliah">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-graduation-cap text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Mata Kuliah</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::path() == 'jadwal' ? 'active' : '' }}" href="/jadwal-new">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-clock text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Jadwal</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::path() == 'jadwal' ? 'active' : '' }}" href="/absensi">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-clock text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Absensi</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::path() == 'rekap-laporan-kehadiran' ? 'active' : '' }}" href="/rekap-laporan-kehadiran">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-clock text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Rekap Kehadiran</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::path() == 'sp' ? 'active' : '' }}" href="/sp">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-newspaper text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Daftar Sp</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Request::path() == 'mahasiswa-kelas' ? 'active' : '' }}" href="/profile">
                    <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                    <i class="fa fa-user text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Profile</span>
                </a>
            </li>
        @elseif (Auth::user()->role->role_name == 'mahasiswa')
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'mahasiswa-kelas' ? 'active' : '' }}" href="/profile">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'jadwal-perwalian' ? 'active' : '' }}" href="/jadwal-perwalian">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Perwalian</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'mahasiswa-kelas' ? 'active' : '' }}" href="/mahasiswa-kelas">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-users text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kelas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'mahasiswa-mata-kuliah' ? 'active' : '' }}" href="/mahasiswa-mata-kuliah">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-graduation-cap text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Mata Kuliah</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'daftar-nilai' ? 'active' : '' }}" href="{{ Auth::user()->role->role_name == 'dosen' ? '/nilai' : route('daftar-nilai.index') }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-trophy text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Transkrip Nilai</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'daftar-nilai-semester' ? 'active' : '' }}" href="{{ Auth::user()->role->role_name == 'dosen' ? '/nilai' : 'daftar-nilai-semester' }}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-award text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Nilai Semester</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'sp' ? 'active' : '' }}" href="/sp">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-newspaper text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Daftar Sp</span>
            </a>
        </li>
        @elseif (Auth::user()->role->role_name == 'dosen')
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'jadwal-perwalian' ? 'active' : '' }}" href="/jadwal-perwalian">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Perwalian</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'kelas' ? 'active' : '' }}" href="/kelas">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-users text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Kelas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'mata-kuliah' ? 'active' : '' }}" href="/mata-kuliah">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-graduation-cap text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Mata Kuliah</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'jadwal' ? 'active' : '' }}" href="/jadwal-new">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-clock text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Jadwal</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'ubah-jadwal' ? 'active' : '' }}" href="/ubah-jadwal">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-clock text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Ubah Jadwal</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'nilai' ? 'active' : '' }}" href="{{ Auth::user()->role->role_name == 'dosen' ? '/nilai' : route('daftar-nilai.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-award text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Nilai Akhir</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'nilai-tugas' ? 'active' : '' }}" href="/nilai-tugas">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-award text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Nilai Tugas</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'jadwal' ? 'active' : '' }}" href="/rekap-kehadiran">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-clock text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Rekap Kehadiran</span>
            </a>
        </li> --}}
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'rekap-laporan-kehadiran' ? 'active' : '' }}" href="/rekap-laporan-kehadiran">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-clock text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Rekap Kehadiran</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'sp' ? 'active' : '' }}" href="/sp">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-newspaper text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Daftar Sp</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'mahasiswa-kelas' ? 'active' : '' }}" href="/profile">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Profile</span>
            </a>
        </li>
        @elseif(Auth::user()->role->role_name == 'admin polsub')
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'jurusan' ? 'active' : '' }}" href="/jurusan">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-book-open text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Jurusan</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'program-studi' ? 'active' : '' }}" href="/program-studi">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-book text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Program Studi</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'tahun-ajaran' ? 'active' : '' }}" href="/tahun-ajaran">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-calendar text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Tahun Ajaran</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'user' ? 'active' : '' }}" href="/user">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">User</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'orang-tua' ? 'active' : '' }}" href="/orang-tua">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user text-dark text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Orang Tua</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'mahasiswa-kelas' ? 'active' : '' }}" href="/profile">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Profile</span>
            </a>
        </li>
        @elseif (Auth::user()->role->role_name == 'orang tua')
        {{-- <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'mahasiswa-kelas' ? 'active' : '' }}" href="/profile">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'mahasiswa-kelas' ? 'active' : '' }}" href="/mahasiswa-kelas">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-users text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Kelas</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'perwalian' ? 'active' : '' }}" href="/perwalian">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Perwalian</span>
            </a>
        </li> --}}
        @endif
        @else
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'mahasiswa-kelas' ? 'active' : '' }}" href="/profile">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-user text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Profile</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'sp' ? 'active' : '' }}" href="/sp">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-newspaper text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Daftar Sp</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'mahasiswa-mata-kuliah' ? 'active' : '' }}" href="/mahasiswa-mata-kuliah">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-graduation-cap text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Mata Kuliah</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'nilai' ? 'active' : '' }}" href="{{ route('daftar-nilai.index') }}">
                <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-award text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Transkrip Nilai</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'daftar-nilai-semester' ? 'active' : '' }}" href="daftar-nilai-semester">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-award text-dark text-sm opacity-10"></i>
                </div>
                <span class="nav-link-text ms-1">Nilai Semester</span>
            </a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link {{ Request::path() == 'mahasiswa-kelas' ? 'active' : '' }}" href="/mahasiswa-kelas/{{Auth::guard('orang_tua')->user()->id_mahasiswa}}">
              <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                <i class="fa fa-users text-dark text-sm opacity-10"></i>
              </div>
              <span class="nav-link-text ms-1">Kelas</span>
            </a>
        </li> --}}
        @endif

      </ul>
    </div>
  </aside>
