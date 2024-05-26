<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div class="navbar-brand-box">
            <a href="{{ url('disnaker') }}" class="logo">
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
                    <a href="{{ url('disnaker') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i>
                        <span>Dashboard</span></a>
                </li>
                {{-- <li>
                    <a href="{{ url('alumni-disnaker') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i>
                        <span>Data Alumni</span></a>
                </li> --}}
                <li>
                    <a href="{{ url('statistik-disnaker') }}" class="waves-effect"><i
                            class="mdi mdi-checkbox-multiple-marked-outline"></i>
                        <span>Hasil Kuesioner</span></a>
                </li>

                <li class="menu-title">Lainnya</li>

                {{-- <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect"><i
                            class="mdi mdi-diamond-stone"></i><span>Pengaturan</span></a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="ui-buttons.html">Profil</a></li>
                        <li><a href="ui-cards.html">Cards</a></li>
                    </ul>
                </li> --}}

                <li>
                    <a href="{{ url('logout') }}" class=" waves-effect"><i
                            class="mdi mdi-logout"></i><span>Keluar</span></a>
                </li>



            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
