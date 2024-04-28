@extends('layouts.layout')

@section('title', 'поиск работы')

@section('content')
    <link href="css/job_list.css" rel="stylesheet">

    @section('menu')
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
    @endsection

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
            
@endsection