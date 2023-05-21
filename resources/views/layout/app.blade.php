@include('layout.partials.header')

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    @include('layout.partials.profil_info')

                    @include('layout.partials.side_bar')

                    @include('layout.partials.side_bar_footer')
                </div>
            </div>

            @include('layout.partials.navbar')

            @yield('content')

            @include('layout.partials.info_footer')
        </div>
    </div>

    @include('layout.partials.modal')

    @include('layout.partials.footer')

</body>

</html>
