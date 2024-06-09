<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <div class="navbar-brand-box">
            <a href="{{ url('humas') }}" class="logo">
                {{-- <i class="mdi mdi-album"></i> --}}
                <span>
                    TRACER STUDY
                </span>
            </a>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{ url('humas') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i>
                        <span>Dashboard</span></a>
                </li>

                <li>
                    <a href="{{ url('alumni-humas') }}" class="waves-effect"><i class="mdi mdi-school"></i>
                        <span>Data Alumni</span></a>
                </li>
                {{-- <li>
                    <a href="{{ url('jurusan-humas') }}" class="waves-effect"><i class="mdi mdi-book-open"></i>
                        <span>Data Lulusan</span></a>
                </li> --}}
                <li>
                    <a href="{{ url('pegawai') }}" class="waves-effect"><i class="mdi mdi-account-group"></i>
                        <span>Data Pegawai</span></a>
                </li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                            class="mdi mdi-diamond-stone"></i><span>Data Alumni</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('alumni-humas') }}" class="waves-effect"><i
                                    class="mdi mdi-home-analytics"></i>
                                <span>List Data Alumni</span></a>
                        </li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('jurusan-humas') }}" class="waves-effect"><i
                                    class="mdi mdi-home-analytics"></i>
                                <span>Total Lulusan</span></a>
                        </li>
                    </ul>                    
                </li> --}}


                {{-- <li>
                    <a href="{{ url('alumni-humas') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i>
                        <span>Data Alumni</span></a>
                </li>
                <li>
                    <a href="{{ url('jurusan-humas') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i>
                        <span>Data Jurusan</span></a>
                </li> --}}

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                            class="mdi mdi-diamond-stone"></i><span>Data Kuesioner</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('maintenance') }}" class="waves-effect"><i
                                    class="mdi mdi-home-analytics"></i>
                                <span>Kuesioner</span></a>
                        </li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('maintenance') }}" class="waves-effect"><i
                                    class="mdi mdi-home-analytics"></i>
                                <span>Pertanyaan</span></a>
                        </li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('maintenance') }}" class="waves-effect"><i
                                    class="mdi mdi-home-analytics"></i>
                                <span>Jawaban Opsi</span></a>
                        </li>
                    </ul>
                </li> --}}
                <li>
                    <a href="{{ url('hasil-kuesioner-humas') }}" class="waves-effect"><i
                            class="mdi mdi-checkbox-multiple-marked-outline"></i>
                        <span>Hasil Kuesioner</span></a>
                </li>
                <li>
                    <a href="{{ url('statistik-humas') }}" class="waves-effect"><i class="mdi mdi-chart-areaspline"></i>
                        <span>Statistik</span></a>
                </li>

                <li class="menu-title">Lainnya</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                            class="mdi mdi-settings-outline"></i><span>Pengaturan</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('profil-humas/' . Auth::user()->username) }}">Profil</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{ url('logout') }}" id="logoutButton" class="waves-effect">
                        <i class="mdi mdi-logout"></i><span>Keluar</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
