<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>

        <link href="{{asset('css/av-dropdown.css?v=').time()}}" rel="stylesheet">
        <link href="{{asset('css/av-buttons.css?v=').time()}}" rel="stylesheet">
        <link href="{{asset('css/clear.css?v=').time()}}" rel="stylesheet">
        <link href="{{asset('css/fonts.css?v=').time()}}" rel="stylesheet">
        <link href="{{asset('css/common.css?v=').time()}}" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </head>

    <body>
        
        <header>
            <a href="/vacancy_search">
                <img src="{{ asset('images/logo.svg') }}" alt="logo" class="logo">
            </a>
            <div class="menu">
                @guest
                    <a href="/login" class="w-head-btn">войти</a>
                    <a href="/register">зарегистрироваться</a>
                @endguest
        
                @auth
                    {{-- <a href="/logout" class="w-head-btn">выйти</a> --}}
        
                    @if(auth()->user()->hasRole('applicant'))
                        <a href="/favorite_vacancies" class="icon-block ">
                            <img src="{{ asset('icons/gray/bookmark.svg') }}" alt="icon">
                            избранное
                        </a>
                        <a href="/applicant_responses" class="icon-block">
                            <img src="{{ asset('icons/gray/hand-tap.svg') }}" alt="icon">
                            отклики
                        </a>
                    @elseif(auth()->user()->hasRole('recruiter'))
                        <a href="/recruiter_responses" class="icon-block">
                            <img src="{{ asset('icons/gray/hand-tap.svg') }}" alt="icon">
                            отклики
                        </a>
                        <a href="/recruiter_vacancies" class="icon-block">
                            <img src="{{ asset('icons/gray/brush.svg') }}" alt="icon">
                            мои вакансии
                        </a>
                    @endif

                    <div class="dropdown">
                        <a href="/profile/{{ auth()->user()->id }}" class="icon-block dropdown-toggle">
                            <img src="{{  asset('icons/gray/user.svg') }}" alt="icon" class="av-img">
                            {{ auth()->user()->name }}
                        </a>
                        <div class="dropdown-menu">
                            <a href="/profile/{{ auth()->user()->id }}" class="drop-box">профиль</a>
                            <a href="/logout"  class="drop-box">выйти</a>
                        </div>
                    </div>
                @endauth
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