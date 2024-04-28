<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Наименование вакансии</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&display=swap" rel="stylesheet">

    <link href="{{ asset('css/clear.css') }}" rel="stylesheet">
    {{-- <link href="{{ asset('css/fonts.css') }}" rel="stylesheet">
    <link href="{{ asset('css/base.css') }}" rel="stylesheet"> --}}
</head>

<style>
    body {
        display: flex;
        flex-direction: column;

        font-size: 16px;
        font-family: "Manrope", sans-serif;
        font-weight: 500;
        letter-spacing: -0.05em;

        background-color: #F3F6F6;
        background-image: url(asset('images/blure.png'));
        background-repeat: no-repeat;
        background-position: center;
        background-size: cover;
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
        padding-block: 80px;

        display: flex;
        flex-direction: column;
        justify-content: center;
        row-gap: 30px;
    }

    .input-group {
        position: relative;
        display: inline-block;
    }

    .search-box {
        margin-left: auto;
        margin-right: auto;
        text-align: center;

        display: flex;
        flex-direction: column;
        gap: 30px;
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
        padding: 15px 40px;
        border-radius: 999px;
        background-color: #3FA3FF;
        color: #EFFBFF;
        font-weight: 500;
    }

    .av-btn-v2:hover {
        background-color: #318eff;
    }

    .jobs {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .job-card {
        display: flex;
        flex-direction: column;
        row-gap: 30px;

        width: 480px;
        border-radius: 24px;
        padding: 40px;

        background-color: #FFFFFF;
    }

    .job-card .l1-data {
        display: flex;
        position: relative;
        column-gap: 30px;
    }

    .job-card .l1-data::after {
        content: "";
        position: absolute;
        bottom: -15px; /* Регулируйте этот отступ, чтобы переместить линию вверх или вниз */
        left: 0;
        width: 100%;
        height: 1px; /* Регулируйте эту высоту, чтобы изменить толщину линии */
        background-color: #F3F6F6; /* Измените этот цвет, чтобы изменить цвет линии */
    }

    .job-card .job-img {
        width: 80px;
        height: auto;
        border-radius: 100%;
    }

    .job-card .l1-data .text-content {
        display: flex;
        flex-direction: column;
        row-gap: 5px;
        font-size: 24px;
    }

    .job-card .l1-data h3 {
        font-weight: 700;
    }

    .job-card .l1-data p {
        display: inline-block;

        padding: 5px 15px;
        border-radius: 999px;
        font-weight: 500;

        background-color: #EFFBFF;
    }

    .job-card .l2-data {
        display: flex;
        column-gap: 15px;
    }

    .job-card .l3-data{
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
    }
    
    .job-card .l3-data p {
        color: #979797;
    }

    .job-card .l3-data .btns {
        display: flex;
        column-gap: 10px;
        align-items: center;
    }

    .job-card .l3-data .icon-btn {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 48px;
        height: 48px;
        border-radius: 100%;
        border: 2px solid #242424;
    }

    .job-card .l3-data .icon-btn:hover {
        background-color: #242424;
    }

    .tag {
        display: flex;
        column-gap: 5px;
        align-items: center;
    }


    footer {
        margin-top: auto;

        display: flex;
        flex-direction: column;
        justify-content: flex-end;

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
                    <a href="/">войти</a>
                </div>
                <div>
                    <a href="/">зарегистрироваться</a>
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
                <h2>«Наименование вакансии»</h2>
                <p>найдено <span>N вакансий<span></p>

                <form action="" method="GET">
                    <div class="input-group">
                        <input 
                        type="text" 
                        name="query" 
                        class="search" 
                        placeholder="Какая вакансия вас интересует?">
                        <button type="submit">найти</button>
                    </div>
                </form>
            </div>

            <div class="job-sort">
                <select class="list">
                    <option value="new" selected>сначала новые</option>
                    <option value="old">сначала старые</option>
                    <option value="responses">по откликам</option>
                </select>
            </div>

            <div class="jobs">
                <div class="job-card">
                    <div class="l1-data">
                        <img src="{{ asset('images/job_prev.jpg') }}" alt="preview" class="job-img">
                        <div class="text-content">
                            <h3>Middle+ Front-end Dev...</h3>
                            <p>40 000 — 100 000<span>₽</span></p>
                        </div>
                    </div>
                    
                    <div class="l2-data">
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/map-pin.svg') }}" alt="gem">
                            Севастополь
                        </div>
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/toolbox.svg') }}" alt="gem">
                            Опыт от 1 года
                        </div>
                    </div>

                    <div class="l3-data">
                        <div class="btns">
                            <button class="av-btn-v2">откликнуться</button>
                            <button class="favorite-btn"><img src="{{ asset('icons/chunk/gem.svg') }}" alt="gem"></button>
                        </div>
                        <p>26.04.2024</p>
                    </div>
                </div>
                <div class="job-card">
                    <div class="l1-data">
                        <img src="{{ asset('images/job_prev.jpg') }}" alt="preview" class="job-img">
                        <div class="text-content">
                            <h3>UI/UX Дизайнер</h3>
                            <p>40 000 — 100 000<span>₽</span></p>
                        </div>
                    </div>
                    
                    <div class="l2-data">
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/map-pin.svg') }}" alt="gem">
                            Севастополь
                        </div>
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/toolbox.svg') }}" alt="gem">
                            Опыт от 1 года
                        </div>
                    </div>
    
                    <div class="l3-data">
                        <div class="btns">
                            <button class="av-btn-v2">откликнуться</button>
                            <button class="icon-btn"><img src="{{ asset('icons/chunk/gem.svg') }}" alt="gem"></button>
                        </div>
                        <p>26.04.2024</p>
                    </div>
                </div>
                <div class="job-card">
                    <div class="l1-data">
                        <img src="{{ asset('images/job_prev.jpg') }}" alt="preview" class="job-img">
                        <div class="text-content">
                            <h3>UI/UX Дизайнер</h3>
                            <p>40 000 — 100 000<span>₽</span></p>
                        </div>
                    </div>
                    
                    <div class="l2-data">
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/map-pin.svg') }}" alt="gem">
                            Севастополь
                        </div>
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/toolbox.svg') }}" alt="gem">
                            Опыт от 1 года
                        </div>
                    </div>
    
                    <div class="l3-data">
                        <div class="btns">
                            <button class="av-btn-v2">откликнуться</button>
                            <button class="icon-btn"><img src="{{ asset('icons/chunk/gem.svg') }}" alt="gem"></button>
                        </div>
                        <p>26.04.2024</p>
                    </div>
                </div>
                <div class="job-card">
                    <div class="l1-data">
                        <img src="{{ asset('images/job_prev.jpg') }}" alt="preview" class="job-img">
                        <div class="text-content">
                            <h3>UI/UX Дизайнер</h3>
                            <p>40 000 — 100 000<span>₽</span></p>
                        </div>
                    </div>
                    
                    <div class="l2-data">
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/map-pin.svg') }}" alt="gem">
                            Севастополь
                        </div>
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/toolbox.svg') }}" alt="gem">
                            Опыт от 1 года
                        </div>
                    </div>
    
                    <div class="l3-data">
                        <div class="btns">
                            <button class="av-btn-v2">откликнуться</button>
                            <button class="icon-btn"><img src="{{ asset('icons/chunk/gem.svg') }}" alt="gem"></button>
                        </div>
                        <p>26.04.2024</p>
                    </div>
                </div>
                <div class="job-card">
                    <div class="l1-data">
                        <img src="{{ asset('images/job_prev.jpg') }}" alt="preview" class="job-img">
                        <div class="text-content">
                            <h3>UI/UX Дизайнер</h3>
                            <p>40 000 — 100 000<span>₽</span></p>
                        </div>
                    </div>
                    
                    <div class="l2-data">
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/map-pin.svg') }}" alt="gem">
                            Севастополь
                        </div>
                        <div class="tag">
                            <img src="{{ asset('icons/chunk/toolbox.svg') }}" alt="gem">
                            Опыт от 1 года
                        </div>
                    </div>
    
                    <div class="l3-data">
                        <div class="btns">
                            <button class="av-btn-v2">откликнуться</button>
                            <button class="icon-btn"><img src="{{ asset('icons/chunk/gem.svg') }}" alt="gem"></button>
                        </div>
                        <p>26.04.2024</p>
                    </div>
                </div>
            </div>

            {{-- <div class="pagination">
                <div class="page">1</div>
                <div class="page">2</div>
                <div class="page">3</div>
            </div> --}}
        </div>
            

        <footer>
            <div class="site-data">
                <p>© 2024 Некоммерческий проект «Агрегатор ваканнсий»</p>
                <p>design by <span>Vladislav Melnichuk</span></p>
            </div>
        </footer>
    </body>
</html>