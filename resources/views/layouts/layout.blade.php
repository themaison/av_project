<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>
        <link href="css/clear.css" rel="stylesheet">
        <link href="css/fonts.css" rel="stylesheet"> 
        <link href="css/common.css" rel="stylesheet">
    </head>

    <body>
        
        <header>
            <a href="/job_search">
                <img src="{{ asset('images/logo.svg') }}" alt="logo" class="logo">
            </a>
            <div class="menu">
                @yield('menu')
            </div>
        </header>

        @yield('content')

        <footer>
            <div class="site-data">
                <p>© 2024 Некоммерческий проект «Агрегатор ваканнсий»</p>
                <p>design by <span>Vladislav Melnichuk</span></p>
            </div>
        </footer>

    </body>
</html>