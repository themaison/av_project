@extends('layouts.layout')

@section('title', 'Отклики')

@section('content')
    <link href="{{asset('css/vacancy_responses.css?v=').time()}}" rel="stylesheet">

    @section('menu')
        <div class="av-btn-v1">
            Войти
        </div>
        <div class="av-btn-v2">
            Зарегистрироваться
        </div>
        <div class="av-btn-v2">
            Избранное
        </div>
        <div class="av-btn-v2">
            Отклики
        </div>
        <div class="av-btn-v2">
            Имя
        </div>
    @endsection

    <div class="content">

        <div class="jobs">
            <div class="job-card">
                <div class="l1-data">
                    <img src="" alt="preview">
                    <div class="text-content">
                        <p>Наименование вакансии</p>
                        <p>40 000 — 100 000<span>₽</span></p>
                    </div>
                </div>
                
                <div class="l2-data">
                    <p>Севастополь</p>
                    <p>Опыт от 1 года</p>
                </div>

                <div class="l3-data">
                    <div class="btns">
                        <button>откликнуться</button>
                        <button>в избранное</button>
                    </div>
                </div>
                <p>26.04.2024</p>
            </div>
        </div>

        <div class="pagination">
            <div class="page">1</div>
            <div class="page">2</div>
            <div class="page">3</div>
        </div>
@endsection