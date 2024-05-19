<div id="layout-wrapper">
    {{-- header --}}
    @include('layouts.header')
    {{-- aside --}}
    @include('layouts.partials.aside-humas')
    <div class="main-content">
        <div class="page-content">
            {{-- content main --}}
            @yield('content')
            {{-- content main --}}
            <!--begin::Footer-->
            @include('layouts.footer')
            <!--end::Footer-->
        </div>
    </div>
</div>
