<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <div class="navbar-brand-box">
            <a href="{{ url('alumni') }}" class="logo">
                <i class="mdi mdi-album"></i>
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
                    <a href="{{ url('alumni') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="{{ url('kuesioner-alumni') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i>
                        <span>Kuesioner</span></a>
                </li>
                <li>
                    <a href="{{ url('riwayat-kuesioner-alumni') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i>
                        <span>Riwayat Pengisian Kuesioner</span></a>
                </li>
                <li class="menu-title">Lainnya</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                            class="mdi mdi-diamond-stone"></i><span>Pengaturan</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('profil-alumni/'. Auth::user()->username) }}">Profil</a></li>
                    </ul>
                </li>

                <li><a href="calendar.html" class=" waves-effect"><i
                            class="mdi mdi-calendar-range-outline"></i><span>Keluar</span></a></li>



            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
