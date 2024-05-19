<div id="layout-wrapper">
    {{-- header --}}
    @include('layouts.header')
    {{-- aside --}}
    @include('layouts.partials.aside')
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
