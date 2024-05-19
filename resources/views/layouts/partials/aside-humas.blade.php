<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <div class="navbar-brand-box">
            <a href="{{ url('humas') }}" class="logo">
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
                    <a href="{{ url('humas') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i>
                        <span>Dashboard</span></a>
                </li>
                <li>
                    <a href="{{ url('alumni-humas') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i>
                        <span>Data Alumni</span></a>
                </li>
                <li>
                    <a href="{{ url('jurusan-humas') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i>
                        <span>Data Jurusan</span></a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                            class="mdi mdi-diamond-stone"></i><span>Data Kuesioner</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ url('maintenance') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i>
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
                            <a href="{{ url('maintenance') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i>
                                <span>Jawaban Opsi</span></a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="{{ url('maintenance') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i>
                        <span>Statistik</span></a>
                </li>

                <li class="menu-title">Lainnya</li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                            class="mdi mdi-diamond-stone"></i><span>Pengaturan</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ url('maintenance') }}">Profil</a></li>
                        {{-- <li><a href="ui-cards.html">Cards</a></li> --}}
                    </ul>
                </li>

                <li><a href="{{ url('logout') }}" class=" waves-effect"><i
                            class="mdi mdi-calendar-range-outline"></i><span>Keluar</span></a></li>



            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->