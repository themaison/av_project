<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title')</title>

        <link href="{{asset('css/clear.css?v=').time()}}" rel="stylesheet">
        <link href="{{asset('css/fonts.css?v=').time()}}" rel="stylesheet">
        <link href="{{asset('css/common.css?v=').time()}}" rel="stylesheet">
    </head>

    <body>
        
        <header>
            <a href="/vacancy_search">
                <img src="{{ asset('images/logo.svg') }}" alt="logo" class="logo">
            </a>
            <div class="menu">
                @guest
                    <a href="/login_form" class="w-head-btn">войти</a>
                    <a href="/register_form">зарегистрироваться</a>
                @endguest
        
                @auth
                    <a href="/logout" class="w-head-btn">выйти</a>
        
                    @if(auth()->user()->hasRole('applicant'))
                        <a href="/favorite_vacancies">избранное</a>
                        <a href="/applicant_responses">отклики</a>
                    @elseif(auth()->user()->hasRole('recruiter'))
                        <a href="/recruiter_responses">отклики</a>
                        <a href="/recruiter_vacancies">мои вакансии</a>
                    @endif

                    <a href="/profile" class="icon-block">
                        <img src="{{  asset('icons/light/user.svg') }}" alt="icon" class="av-img">
                        {{ auth()->user()->name }}
                    </a>
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