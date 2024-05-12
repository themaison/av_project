@extends('layouts.layout')

@section('title', 'мои вакансии')

<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     // Показать модальное окно при нажатии на кнопку "редактировать"
    //     document.querySelector('#edit-btn').addEventListener('click', function() {
    //         document.getElementById('edit-modal').style.display = 'block';
    //     });

    //     // Скрыть модальное окно при нажатии на кнопку "x-btn"
    //     document.querySelector('.x-btn').addEventListener('click', function() {
    //         document.getElementById('edit-modal').style.display = 'none';
    //     });
    //     document.getElementById('edit-cancel').addEventListener('click', function() {
    //         document.getElementById('edit-modal').style.display = 'none';
    //     });
    // });
    document.addEventListener('DOMContentLoaded', function() {
        var modal = document.getElementById('edit-modal');

        // Показать модальное окно при нажатии на кнопку "редактировать"
        document.getElementById('edit-btn').addEventListener('click', function() {
            modal.style.display = 'block';
            document.body.classList.add('modal-open');
        });

        // Скрыть модальное окно при нажатии на кнопку "x-btn"
        document.querySelector('.x-btn').addEventListener('click', function() {
            modal.style.display = 'none';
            document.body.classList.remove('modal-open');
        });

        document.getElementById('edit-cancel').addEventListener('click', function() {
            modal.style.display = 'none';
            document.body.classList.remove('modal-open');
        });

        // Скрыть модальное окно при нажатии вне его
        window.addEventListener('click', function(event) {
            if (event.target == modal) {
                modal.style.display = 'none';
                document.body.classList.remove('modal-open');
            }
        });
    });

</script>

@section('content')
    <link href="{{asset('css/av-cover.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-list.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-form.css?v=').time()}}" rel="stylesheet">
    <link href="{{ asset('css/recruiter_vacancies.css?v=').time() }}" rel="stylesheet">

    <div class="content">

        <div class="title">
            <h2>мои вакансии</h2>
            <p>редактируйте и создавайте новые вакансии<br>
            привлекайте новых соискателей и отбирайте лучших из них</p>
            {{-- <button class="fill-btn"><img src="{{ asset('icons/light/brush.svg') }}" alt="icon"><a href="/recruiter_vacancies/new_vacancy/">создать вакансию</a></button> --}}
            <a href="/recruiter_vacancies/new_vacancy/" class="fill-btn">
                <img src="{{ asset('icons/light/brush.svg') }}" alt="icon">
                создать вакансию
            </a>
        </div>

        @isset($vacancies)
            <div class="av-list">
                
                @forelse ($vacancies as $vacancy)
                    <div class="l-row">
                        <div class="set">

                            <div class="elem">
                                <p class="hint-text">{{ $vacancy->created_at }}</p>
                            </div>

                            <a href="/vacancy_detail/{{ $vacancy->id }}" class="elem">
                                @if($vacancy->cover)
                                    <div class="cover">
                                        <img src="{{ Storage::url($vacancy->cover) }}" alt="cover">
                                    </div>
                                    {{-- <img src="{{ Storage::url($vacancy->cover) }}" class="av-img"> --}}
                                @else
                                    {{-- <div class="av-img"></div> --}}
                                    <div class="cover"></div>
                                @endif
                                <p>{{ $vacancy->title }}</p>
                            </a>

                        </div>

                        <div class="double-btn">

                            {{-- <div class="outline-btn" id="v-edit-{{ $vacancy->id }}">
                                <img src="{{ asset('icons/black/pencil.svg') }}" alt="icon">
                                редактировать
                            </div> --}}

                            <button type="button" class="outline-btn" id="edit-btn" data-toggle="modal" data-target="#edit-modal">
                                <img src="{{ asset('icons/black/pencil.svg') }}" alt="icon">
                                редактировать
                            </button>
 
                            <form action="/recruiter_vacancies/vacancy_delete/{{ $vacancy->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="outline-btn square-btn">
                                    <img src="{{ asset('icons/black/trash.svg') }}" alt="icon">
                                </button>
                            </form>

                        </div>

                    </div>
                @empty
                    <p>У вас пока нет вакансий.</p>
                @endforelse

            </div>
        @endisset
                
        <div class="edit-modal" id="edit-modal">
            <button type="submit" class="x-btn">
                <img src="{{ asset('icons/black/x.svg') }}" alt="icon">
            </button>
            <form class="av-form" method="PUT" action="">
                @csrf

                <div class="form-title">
                    <h3>Редактировать вакансию</h3>
                </div>

                <div class="inputs-block">

                    <div class="inline-blocks">
                        <div class="input-block" id="title-block">
                            <label for="title">название вакансии</label>
                            <input class="title-text" type="text" name="title" value="{{ $vacancy->title }}" placeholder="введите текст...">
                            
                            @error('title')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>
        
                        <div class="input-block">

                            <label for="cover">обложка вакансии</label>
                            <p class="hint-text" id="file_cover-text">желательный формат .png или .jpg</p>
                            
                            {{-- <div class="cover">
                                <img src="{{  asset('images/love.jpg') }}" alt="">
                            </div> --}}

                            <input type="file" class="file-cover" name="cover" value="{{ Storage::url($vacancy->cover) }}" accept=".png, .jpg, .jpeg"/>

                            <p class="error-text cover-error"></p>

                        </div>
                    </div>

                    <div class="inline-blocks">
                        <div class="input-block">
                            <label for="company">компания (ИП)</label>
                            <input type="text" name="company"  value="{{ $vacancy->company }}" placeholder="введите текст...">
                            
                            @error('company')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-block">
                            <label for="city">город</label>
                            <input type="text" name="city"  value="{{ $vacancy->city }}" placeholder="введите текст...">
                            
                            @error('city')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="inline-blocks">
                        <div class="input-block">
                            <label for="experience">опыт работы (год)</label>
                            <input type="number" name="experience" value="{{ $vacancy->experience }}" placeholder="введите число">
                        </div>

                        <div class="input-block">
                            <label for="salary">заработная плата (₽)</label>
        
                            <div class="double-block">
                                <div class="input-block">
                                    <input type="text" name ="salary-from"  value="{{ $vacancy->salary_from }}" placeholder="от 10 000">
                                </div>
        
                                <div>—</div>
        
                                <div class="input-block">
                                    <input type="text" name ="salary-to"  value="{{ $vacancy->salary_to }}" placeholder="до 100 000">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="inline-blocks">
                        <div class="input-block">
                            <label for="responsibilities">обязанности</label>
                            <textarea name="responsibilities" placeholder="введите текст...">{{ $vacancy->responsibilities }}</textarea>
                        </div>

                        <div class="input-block">
                            <label for="requirements">требования</label>
                            <textarea name="requirements" placeholder="введите текст...">{{ $vacancy->requirements }}</textarea>
                        </div>
                    </div>

                    <div class="inline-blocks">
                        <div class="input-block" id="conditions-block">
                            <label for="conditions">условия</label>
                            <textarea name="conditions" placeholder="введите текст...">{{ $vacancy->conditions }}</textarea>
                        </div>

                        <div class="input-block">
                            <label for="skills">навыки</label>
                            <p class="hint-text">введите навыки через запятую</p>
                            <textarea name="skills" placeholder="введите текст...">{{ $vacancy->skills }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="edit-buttons">
                    <button type="button" class="outline-btn" id="edit-cancel">
                        отмена
                    </button>
                    <button type="button" class="fill-btn" id="edit-submit">
                        сохранить
                    </button>
                </div>
            </form>
        </div>

    </div>
@endsection