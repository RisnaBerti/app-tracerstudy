<div class="header-border"></div>
<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex align-items-left">
            <button type="button" class="btn btn-sm mr-2 d-lg-none px-3 font-size-16 header-item waves-effect"
                id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

        </div>
        <div class="d-flex align-items-center">
            {{-- <div class="dropdown d-none d-sm-inline-block ml-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="mdi mdi-magnify"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Recipient's username">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i
                                            class="mdi mdi-magnify"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div> --}}
            <div class="dropdown d-inline-block ml-2">
                <button type="button" class="btn header-item waves-effect" data-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    @php
                        $user = Auth::user();
                        $defaultImage = 'uploads/default.png'; // Default image if no profile image is found
                        $imagePath = $defaultImage;
                        $nama = $user->username; // Default to username if no specific name is found

                        if ($user->pegawai) {
                            $imagePath = 'uploads/pegawai/' . $user->pegawai->foto_pegawai;
                            $nama = $user->pegawai->nama_pegawai;
                        } elseif ($user->alumni) {
                            $imagePath = 'uploads/alumni/' . $user->alumni->foto_alumni;
                            $nama = $user->alumni->nama_alumni;
                        }
                    @endphp
                    <img class="rounded-circle header-profile-user" src="{{ asset($imagePath) }}" alt="foto">
                    <span class="d-none d-sm-inline-block ml-1">
                        {{ $nama }}
                    </span>
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    @if (Auth::user()->id_role == 1)
                        <a class="dropdown-item d-flex align-items-center justify-content-between"
                            href="{{ url('profil-bkk/' . Auth::user()->username) }}">
                            <span>Profil</span>
                        </a>
                    @elseif (Auth::user()->id_role == 2)
                        <a class="dropdown-item d-flex align-items-center justify-content-between"
                            href="{{ url('profil-humas/' . Auth::user()->username) }}">
                            <span>Profil</span>
                        </a>
                    @elseif (Auth::user()->id_role == 4)
                        <a class="dropdown-item d-flex align-items-center justify-content-between"
                            href="{{ url('profil-alumni/' . Auth::user()->username) }}">
                            <span>Profil</span>
                        </a>
                    @endif
                    <a href="{{ url('logout') }}" id="logoutButton"
                        class="dropdown-item d-flex align-items-center justify-content-between">
                        <span>Log Out</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</header>
