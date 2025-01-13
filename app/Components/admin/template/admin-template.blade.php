<?php

?> 
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=htmlspecialchars(isset($meta_title) ? $meta_title : 'IT roadmap') ?></title>
    @yield('head_content')
    <link href="{{ mix('css/app-admin.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@1.13.1/css/OverlayScrollbars.min.css" integrity="sha256-WKijf8KI68sbq8Znd6yMepIuFF0wdWfIt6gk3JWcQfk=" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/all.min.css" integrity="sha256-mUZM63G8m73Mcidfrv5E+Y61y7a12O5mW4ezU3bxqW4=" crossorigin="anonymous">
    <link rel="stylesheet" href="/admin_lte/css/adminlte.css">
    @stack('style')
</head>
<body>
    <div id="app">
        <div class="container-fullwidth">
            <div class="d-flex vh-100">
                @include('admin.template.admin-left-menu')
                <div class="d-flex flex-column flex-fill">
                    <header>
                        @include('admin.template.admin-top-menu')
                    </header>
                    <main class="d-flex flex-fill justify-content-center align-items-center">
                        @yield('main-content')
                    </main>
                    <footer class="ftco-footer ftco-bg-dark ftco-section footer-info">
                        @yield('footer')
                    </footer>
                </div>
            </div>
        </div>
    </div>
    
    <script src="{{mix('js/app-admin.js')}}"></script>
    <script src="/admin_lte/js/adminlte.js"></script>
    @stack('scripts')
</body>
</html>