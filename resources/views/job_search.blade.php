<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>поиск работы</title>
    <link href="{{ asset('css/clear.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

</head>

<style>
    body {
        display: flex;
        flex-direction: column;
        min-height: 100vh;

        font-size: 16px;
        font-family: "Manrope", sans-serif;
        font-weight: 500;
        letter-spacing: -0.05em;

        background-color: #F3F6F6;
    }

    header {
        display: flex;
        justify-content: space-between;
        align-items: center;

        height: 80px;
        padding-inline:5%;

        background-color: #242424;
        color: #EFFBFF;
    }

    .logo {
        height: 35px;
        width: 150px;
    }

    .menu {
        display: flex;
        align-items: center;
        column-gap: 30px;
    }

    .menu a {
        text-decoration: none;
        color: #979797;
    }

    .menu a:hover {
        text-decoration: none;
        color: #EFFBFF;
    }

    .content {
        padding-inline:5%;
        padding-block: 120px;
    }

    .input-group {
        position: relative;
        display: inline-block;
    }

    .user-role {
        display: flex;
        margin-left: auto;
        margin-right: auto;
        column-gap: 10px;
        justify-content: center;
    }

    .role-btn {
        padding: 5px 10px;
        border-radius: 999px;
        border: 2px solid #242424;
    }

    #active-role, .role-btn:hover {
        background-color: #242424;
        color:#EFFBFF;
        cursor: pointer;
    }

    .search-box {
        margin-left: auto;
        margin-right: auto;
        text-align: center;

        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .search {
        width: 480px;
        height: 56px;
        border-radius: 999px;
        padding: 17px 150px 17px 30px;

        font-family: "Manrope", sans-serif;
        font-weight: 500;

        background-color: #FFFFFF;
    }

    .search-box button {
        width: 123px;
        height: 48px;
        border-radius: 999px;

        font-family: "Manrope", sans-serif;
        font-weight: 500;

        background-color: #242424;
        color: #EFFBFF;

        position: absolute;
        right: 4px;
        top: 4px;
    }

    h1 {
        font-size: 96px;
        font-weight: 700;
        letter-spacing: -0.05em;
    }

    h2 {
        font-size: 48px;
        font-weight: 700;
        letter-spacing: -0.05em;
    }

    .search-box span {
        color: #3FA3FF;
    }

    .av-btn-v1 {
        padding: 10px 30px;
        border-radius: 999px;
        border: 2px solid #EFFBFF;
    }

    .av-btn-v1:hover {
        color: #EFFBFF;
        background-color: #323232;
        cursor: pointer;
    }

    .av-btn-v1 a {
        color: #EFFBFF;
    }

    .av-btn-v2 {
        padding: 10px 30px;
        border-radius: 999px;
    }

    footer {
        margin-top: auto;

        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        position: relative;
        bottom: 0;

        height: 320px;
        padding-inline: 5%;
        padding-block: 60px;

        background-color: #242424;
        color: #979797;
    }

    footer .site-data {
        display: flex;
        flex-direction: row;
        justify-content: space-between;

        font-size: 12px;
        letter-spacing: -0.03em;
    }

    footer p {
        display: inline-block;
    }

    footer span {
        color: #EFFBFF;
    }

</style>

<body>
    <header>
        <a href="/job_search">
            <img src="{{ asset('images/logo.svg') }}" alt="logo" class="logo">
        </a>
        <div class="menu">
            <div class="av-btn-v1">
                <a href="/login">войти</a>
            </div>
            <div>
                <a href="/register">зарегистрироваться</a>
            </div>
            <div>
                <a href="/favourite_jobs">избранное</a>
            </div>
            <div>
                <a href="/job_responses">отклики</a>
            </div>
            <div>
                <a href="/profile">имя</a>
            </div>
        </div>
    </header>
    <div class="content">

        <div class="search-box">
            <div class="user-role">
                <div class="role-btn" id="active-role">
                    я соискатель
                </div>
                <div class="role-btn">
                    я работодатель
                </div>
            </div>

            <h1>найди работу своей мечты</h1>
            <p>Более <span>1000</span> актуальных вакансий для всех</p>

            <form action="/job_list" method="GET">
                <div class="input-group">
                    <input type="text" name="query" class="search" placeholder="Какая вакансия вас интересует?">
                    <button class="av-btn-v2" type="submit">найти</button>
                </div>
            </form>
        </div>
    </div>

    <footer>
        <div class="site-data">
            <p>© 2024 Некоммерческий проект «Агрегатор ваканнсий»</p>
            <p>design by <span>Vladislav Melnichuk</span></p>
        </div>
    </footer>

</body>
</html>