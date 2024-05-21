@extends('layouts.layout')

@section('title', 'мои вакансии')

@section('content')
    <link href="{{asset('css/av-list.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-cover.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-form.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-pagination.css?v=').time()}}" rel="stylesheet">
    <link href="{{ asset('css/recruiter_vacancies.css?v=').time() }}" rel="stylesheet">
    
    <script>
        window.onload = function() {
            var modules = document.getElementsByClassName('av-form-module');
            var nextButtons = document.getElementsByClassName('next-btn');
            var prevButtons = document.getElementsByClassName('prev-btn');
            var currentModule = 0;

            // Начальное состояние: показываем только первый модуль
            for (var i = 0; i < modules.length; i++) {
                modules[i].style.display = 'none';
            }
            modules[currentModule].style.display = 'flex';

            // Обработчики событий для кнопок "Дальше"
            for (var i = 0; i < nextButtons.length; i++) { // Исключаем последнюю кнопку "Дальше"
                nextButtons[i].addEventListener('click', function(e) {
                    e.preventDefault();
                    if (currentModule < modules.length - 1) {
                        modules[currentModule].style.display = 'none';
                        currentModule++;
                        modules[currentModule].style.display = 'flex';
                    }
                });
            }

            // Обработчики событий для кнопок "Назад"
            for (var i = 0; i < prevButtons.length; i++) {
                prevButtons[i].addEventListener('click', function(e) {
                    e.preventDefault();
                    if (currentModule > 0) {
                        modules[currentModule].style.display = 'none';
                        currentModule--;
                        modules[currentModule].style.display = 'flex';
                    }
                });
            }

            var cover_input = document.querySelector('.file-cover');

            // Обработчик события изменения input
            cover_input.addEventListener('change', function(e) {
                var file = e.target.files[0];
                var reader = new FileReader();

                reader.onloadend = function() {
                    // Удаляем старый элемент .cover, если он существует
                    var old_cover = document.querySelector('.cover');
                    if (old_cover) {
                        old_cover.remove();
                    }

                    // Создаем новый элемент div и img
                    var cover_div = document.createElement('div');
                    cover_div.className = 'cover';
                    var cover_img = document.createElement('img');
                    cover_img.src = reader.result;

                    // Добавляем img в div
                    cover_div.appendChild(cover_img);

                    // Добавляем div в DOM после .hint-text
                    var anchor = document.querySelector('#file_cover-text');
                    anchor.insertAdjacentElement('afterend', cover_div);
                }

                if (file) {
                    reader.readAsDataURL(file);
                }
            });
        }
        
        $(document).ready(function() {
            if ('{{ $errors->any() }}') { 
                // Показать форму и затемнение
                $('#edit-form').css('display', 'flex');
                $('.blur-bg').fadeIn();
                $('body').addClass('no-scroll');
            }

            $('.edit-btn').click(function() {
                // Получить данные вакансии из атрибутов data-*
                var vacancyId = $(this).data('vacancy-id');
                var title = $(this).data('title');
                var company = $(this).data('company');
                var city = $(this).data('city');
                var experience = $(this).data('experience');
                var salary_from = $(this).data('salary_from');
                var salary_to = $(this).data('salary_to');
                var responsibilities = $(this).data('responsibilities');
                var requirements = $(this).data('requirements');
                var conditions = $(this).data('conditions');
                var skills = $(this).data('skills');
                var cover = $(this).data('cover');

                // console.log(cover);

                // console.log(vacancyId, title, company, city);

                // Обновить данные формы
                $('input[name="title"]').val(title);
                $('input[name="company"]').val(company);
                $('input[name="city"]').val(city);
                $('input[name="experience"]').val(experience);
                $('input[name="salary-from"]').val(salary_from);
                $('input[name="salary-to"]').val(salary_to);
                $('textarea[name="responsibilities"]').val(responsibilities);
                $('textarea[name="requirements"]').val(requirements);
                $('textarea[name="conditions"]').val(conditions);
                $('textarea[name="skills"]').val(skills);

                // Проверяем, есть ли уже элемент img внутри .cover
                var cover_img = $('#edit-form .cover img');
                if (cover_img.length == 0) {
                    // Если нет, создаем его
                    cover_img = $('<img>').appendTo('#edit-form .cover');
                }

                // Устанавливаем или скрываем изображение обложки
                if (cover) {
                    cover_img.attr('src', cover).show();
                } else {
                    cover_img.hide();
                }

                $('.av-form').attr('action', '/vacancy/' + vacancyId + '/update');
                $('.av-form').fadeIn().css('display', 'flex');
                $('.blur-bg').fadeIn();
                $('body').addClass('no-scroll'); // Добавить класс к body
            });

            $('.cancel-btn, .x-btn').click(function() {
                $('.av-form').hide();
                $('.blur-bg').fadeOut();
                $('body').removeClass('no-scroll'); // Удалить класс из body
            });

            // $(document).mouseup(function (e) {
            //     var container = $(".av-form");
            //     if (container.has(e.target).length === 0){
            //         container.fadeOut();
            //         $('.blur-bg').fadeOut();
            //         $('body').removeClass('no-scroll'); // Удалить класс из body
            //     }
            // });
        
            $('.av-form').on('edit-submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: $(this).attr('action'),
                    method: 'PUT',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response.success) {
                            $('.av-form').fadeOut();
                            $('.blur-bg').fadeOut();
                            $('body').removeClass('no-scroll');
                            // return redirect('/recruiter_vacancies');
                        } else {
                            // Обработка ошибок
                        }
                    }
                });
            });
        });
    </script>

    <div class="content">

        <div class="blur-bg"></div>

        <div class="title">
            <h2 style="--i: 0">мои вакансии</h2>
            <p style="--i: 1">редактируйте и создавайте новые вакансии<br>
            привлекайте новых соискателей и отбирайте лучших из них</p>
            
            <a href="/recruiter_vacancies/new_vacancy" class="fill-btn" style="--i: 2">
                <img src="{{ asset('icons/light/brush.svg') }}" alt="icon">
                создать вакансию
            </a>
        </div>

        @if($vacancies->isEmpty())
            <p class="hint-text" style="--i: 3">у вас еще нет вакансий</p>
        @else
            <div class="av-list" style="--i: 3">
                    
                @forelse ($vacancies as $index => $vacancy)
                    <div class="l-row" style="--i:{{ $index + 3}}">
                        <div class="set">

                            <div class="elem">
                                <p class="hint-text">{{ $vacancy->created_at }}</p>
                            </div>

                            <a href="/vacancy_detail/{{ $vacancy->id }}" class="elem">
                                @if($vacancy->cover)
                                
                                    <div class="cover">
                                        <img src="{{ Storage::url($vacancy->cover) }}" alt="cover">
                                    </div>

                                @else
                                    <div class="cover"></div>
                                @endif
                                <p class="vacancy-title">{{ $vacancy->title }}</p>
                            </a>

                        </div>

                        <div class="double-btn">
                            <div class="outline-btn edit-btn" 
                                data-vacancy-id="{{ $vacancy->id }}"
                                data-title="{{ $vacancy->title }}"
                                data-company="{{ $vacancy->company }}"
                                data-city="{{ $vacancy->city }}"
                                data-experience="{{ $vacancy->experience }}"
                                data-salary_from="{{ $vacancy->salary_from }}"
                                data-salary_to="{{ $vacancy->salary_to }}"
                                data-responsibilities="{{ $vacancy->responsibilities }}"
                                data-requirements="{{ $vacancy->requirements }}"
                                data-conditions="{{ $vacancy->conditions }}"
                                data-skills="{{ $vacancy->skills }}"
                                data-cover="{{ Storage::url($vacancy->cover) }}">
                                <img src="{{ asset('icons/black/pencil.svg') }}" alt="icon">
                                изменить
                            </div>

                            {{-- <div class="outline-btn edit-btn" data-vacancy-id="{{ $vacancy->id }}">
                                <img src="{{ asset('icons/black/pencil.svg') }}" alt="icon">
                                изменить
                            </div> --}}

                            <form action="/vacancy/{{ $vacancy->id }}/delete" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn square-btn">
                                    <img src="{{ asset('icons/black/trash.svg') }}" alt="icon">
                                </button>
                            </form>
                        </div>
                    </div>

                @empty
                    <p>У вас пока нет вакансий.</p>
                @endforelse
            </div>

            <div class="pagination" style="--i: 3">
                {{ $vacancies->links('vendor.pagination.custom_pagination') }}
            </div>
      
            <form id="edit-form" class="av-form" method="POST" enctype="multipart/form-data" action="" style="{{ $errors->any() ? 'display: flex' : 'display: none' }}">
                @csrf
                @method('PUT')

                <div class="x-btn">
                    <img src="{{ asset('icons/black/x.svg') }}" alt="icon">
                </div>

                <div class="form-title">
                    <h3>Редактирование</h3>
                    <div class="av-icon">
                        <img src="{{ asset('icons/black/pencil.svg') }}" alt="icon">
                    </div>
                </div>

                <div class="av-form-module" id="module_1">
                    <div class="inputs-block">

                        <div class="input-block">
                            <label for="title">название вакансии</label>
                            <input type="text" name="title" value="{{ old('title') }}" placeholder="введите текст...">
                                
                            @error('title')
                                <p class="error-text">{{ $message }}</p>
                            @enderror
                                
                        </div>
            
                        <div class="input-block">
                            <label for="company">компания (ИП)</label>
                            <input type="text" name="company"  value="{{ old('company') }}" placeholder="введите текст...">
                                
                            @error('company')
                                <p class="error-text">{{ $message }}</p>
                            @enderror       
                        </div>
            
                        <div class="input-block">
                            <label for="city">город</label>
                            <input type="text" name="city"  value="{{ old('city') }}" placeholder="введите текст...">
                                
                            @error('city')
                                <p class="error-text">{{ $message }}</p>
                            @enderror            
                        </div>

                        <div class="input-block">
                            <label for="salary">заработная плата (₽)</label>
        
                            <div class="double-block">
                                <div class="input-block">
                                    <input type="text" name ="salary-from"  value="{{ old('salary-from') }}" placeholder="от 10 000">
                                </div>
        
                                <div>—</div>
        
                                <div class="input-block">
                                    <input type="text" name ="salary-to" value="{{ old('salary-to') }}" placeholder="до 100 000">
                                </div>
                            </div>
                        </div>
            
                        <div class="input-block">
                            <label for="experience">опыт работы (год)</label>
                            <input type="number" name="experience" value="{{ old('experience') }}" placeholder="введите число">
                        </div>
                    </div>

                    <div class="form-nav">
                        <button class="fill-btn next-btn">
                            далее
                            <img src="{{ asset('icons/light/angle-right.svg') }}" alt="icon">
                        </button>
                    </div>
                </div>

                <div class="av-form-module" id="module_2">
                    <div class="inputs-block">
                        <div class="input-block">
                            <label for="responsibilities">обязанности</label>
                            <textarea name="responsibilities" placeholder="введите текст...">{{ old('responsibilities') }}</textarea>
                        </div>

                        <div class="input-block">
                            <label for="requirements">требования</label>
                            <textarea name="requirements" placeholder="введите текст...">{{ old('requirements') }}</textarea>
                        </div>

                        <div class="input-block">
                            <label for="conditions">условия</label>
                            <textarea name="conditions" placeholder="введите текст...">{{ old('conditions') }}</textarea>
                        </div>

                        <div class="input-block">
                            <label for="skills">навыки</label>
                            <p class="hint-text">введите навыки через запятую</p>
                            <textarea name="skills" placeholder="введите текст...">{{ old('skills') }}</textarea>
                        </div>      
                    </div>

                    <div class="form-nav">
                        <button class="outline-btn prev-btn">
                            назад
                        </button>
                        <button class="fill-btn next-btn">
                            далее
                            <img src="{{ asset('icons/light/angle-right.svg') }}" alt="icon">
                        </button>
                    </div>
                </div>

                <div class="av-form-module" id="module_3">
                    <div class="inputs-block">
                        <div class="input-block">

                            <label for="cover">обложка вакансии</label>
                            <p class="hint-text" id="file_cover-text">желательный формат .png или .jpg</p>
                            
                            <div class="cover">
                                <img src="" alt="cover">
                            </div> 
                            
                            {{-- <div class="cover"></div> --}}

                            <input type="file" class="file-cover" name="cover" accept=".png, .jpg, .jpeg"/>

                            <p class="error-text cover-error"></p>

                        </div>
                    </div>
    
                    <div class="form-nav">
                        <button class="outline-btn prev-btn">
                            назад
                        </button>
                        <button type="submit" class="fill-btn" id="edit-submit">
                            сохранить
                        </button>
                    </div>
                </div>
            </form>
        @endif

    </div>
@endsection