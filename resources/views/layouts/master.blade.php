<!DOCTYPE html>
<html lang="en">
{{-- header file --}}
@include('partials.head')

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        @include('partials.header')
        @include('partials.sidebar')
        @yield('content')
        @include('partials.footer')
    </div>
    {{-- JS files --}}
    @include('partials.scripts')
</body>

</html>
