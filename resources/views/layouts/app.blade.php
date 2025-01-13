<?php

?> <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?=htmlspecialchars(isset($meta_title) ? $meta_title : 'IT roadmap') ?></title>
    @yield('head_content')
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @stack('style')
</head>
<body>
    <div id="app">
        <div class="container-fullwidth">
            <div class="d-flex flex-column vh-100">
                <header class="header">
                    @yield('header')
                </header>
                <main class="d-flex align-items-center justify-content-center flex-fill">
                    @yield('content')
                </main>
                <footer class="ftco-footer ftco-bg-dark ftco-section footer-info">
                    @yield('footer')
                </footer>
            </div>
        </div>
    </div>
    
    <script src="{{mix('js/app.js')}}"></script>
    @stack('scripts')
</body>
</html>