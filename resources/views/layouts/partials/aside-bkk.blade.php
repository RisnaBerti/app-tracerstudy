<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <div class="navbar-brand-box">
            <a href="{{ url('bkk') }}" class="logo">
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
                    <a href="{{ url('bkk') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                            class="mdi mdi-folder-text-outline"></i><span>Data Master</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('jurusan') }}" class="waves-effect">
                                <span>Data Jurusan</span></a>
                        </li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('tahun-lulus') }}" class="waves-effect">
                                <span>Tahun Lulus</span></a>
                        </li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('kategori') }}" class="waves-effect">
                                <span>Data Kategori</span></a>
                        </li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('alumni-bkk') }}" class="waves-effect">
                                <span>Data Alumni</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                            class="mdi mdi-file-document-box-multiple"></i><span>Data Kuesioner</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('kuesioner') }}" class="waves-effect">
                                <span>Kuesioner</span></a>
                        </li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('pertanyaan') }}" class="waves-effect">
                                <span>Pertanyaan</span></a>
                        </li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('opsi') }}" class="waves-effect">
                                <span>Jawaban Opsi</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('hasil-kuesioner-bkk') }}" class="waves-effect"><i
                            class="mdi mdi-checkbox-multiple-marked-outline"></i>
                        <span>Hasil Kuesioner</span></a>
                </li>
                <li>
                    <a href="{{ url('statistik-bkk') }}" class="waves-effect"><i class="mdi mdi-chart-areaspline"></i>
                        <span>Statistik</span></a>
                </li>

                <li class="menu-title">Lainnya</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                            class="mdi mdi-settings-outline"></i><span>Pengaturan</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('profil-bkk/' . Auth::user()->username) }}">Profil</a></li>
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
