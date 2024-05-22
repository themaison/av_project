@extends('layouts.layout')

@section('title', 'отклики')

@section('content')
    <link href="{{asset('css/av-cover.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-list.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-form.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-pagination.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/recruiter_responses.css?v=').time()}}" rel="stylesheet">

    <script>
        $(document).ready(function() {
            $('.cover-letter-btn').click(function() {
                var letter = $(this).data('letter');
                $('.av-form p').text(letter);
                $('.av-form').fadeIn().css('display', 'flex');
                $('.blur-bg').fadeIn();
            });

            $('.cancel-btn, .x-btn').click(function() {
                $('.av-form').hide();
                $('.letter-form').fadeOut();
                $('.blur-bg').fadeOut();
            });

            $(document).on('click', '.act-btn-1', function(e) {
                e.preventDefault();
                var responseId = $(this).data('response-id');
                setStatus(responseId, 2, $(this));
            });

            $(document).on('click', '.act-btn-2', function(e) {
                e.preventDefault();
                var responseId = $(this).data('response-id');
                setStatus(responseId, 3, $(this));
            });

            $(document).on('click', '.act-btn-3', function(e) {
                e.preventDefault();
                var responseId = $(this).data('response-id');
                setStatus(responseId, 1, $(this));
            });

            function setStatus(responseId, status_id, clickedButton) {
                $.ajax({
                    url: '/response/' + responseId + '/set_status',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status_id: status_id
                    },
                    success: function(data) {
                        console.log(data);
                        if (data.success) {
                            var statusElement = $('#status-text-' + responseId);
                            var statusText;

                            switch (status_id) {
                                case 1:
                                    statusText = "приглашение";
                                    break;
                                case 2:
                                    statusText = "отказ";
                                    break;
                                case 3:
                                    statusText = "на рассмотрении";
                                    break;
                                case 4:
                                    statusText = "не рассмотрено";
                                    break;
                                default:
                                    statusText = 'неизвестно';
                            }

                            statusElement.text(statusText);

                            statusElement.removeClass('r-stat-1 r-stat-2 r-stat-3 r-stat-4');
                            statusElement.addClass('r-stat-' + status_id);

                            // Находим родительский элемент текущей кнопки
                            var parentElement = clickedButton.closest('.double-btn');
                            // Удаляем класс 'selected' только у кнопок внутри этого элемента
                            parentElement.find('.act-btn-1, .act-btn-2, .act-btn-3').removeClass('selected');
                            // Добавляем класс 'selected' к нажатой кнопке
                            clickedButton.addClass('selected');
                        } else {
                            // Обработка ошибок
                        }
                    }
                });
            }
        });
    </script>   

    <div class="content">
        <div class="title">
            <h2>отклики</h2>
            <p>ваши отклики за последнее время</p>
        </div>

        <div class="blur-bg"></div>

        <div class="av-form" style="display: none">
            @csrf

            <div class="x-btn">
                <img src="{{ asset('icons/black/x.svg') }}" alt="icon">
            </div>

            <div class="form-title">
                <h3 style="--i: 0">Сопр. письмо</h3>

                <div class="av-icon">
                    <img src="{{ asset('icons/black/newspaper.svg') }}" alt="icon">
                </div>

            </div>

            <p style="--i: 1"></p>

        </div>
        
        @if($responses->isEmpty())
            <p class="hint-text" style="--i: 2">откликов нет</p>
        @else
        <div class="av-list" style="--i: 3">
            @foreach($responses as $index => $response)
                <div class="l-row" style="--i: {{ $index}}">
                    <div class="set">

                        <div class="elem">
                            <p class="hint-text">{{ $response->created_at }}</p>
                        </div>

                        <div class="elem">
                            <p id="status-text-{{ $response->id }}" class="status-text {{ $response->status_id == 1 ? 'r-stat-1' : ($response->status_id == 2 ? 'r-stat-2' : ($response->status_id == 3 ? 'r-stat-3' : 'r-stat-4')) }}">
                                {{ $response->status->status }}
                            </p>
                        </div>

                        <a href="/vacancy_detail/{{ $response->vacancy->id }}" class="elem">       
                            @if($response->vacancy->cover)
                                <div class="cover">
                                    <img src="{{ Storage::url($response->vacancy->cover) }}" alt="cover">
                                </div>
                            @else
                                <div class="cover"></div>
                            @endif

                            <p class="response-data">{{ $response->vacancy->title }}</p>  

                            {{-- <div class="icon-block">
                                <img src="{{ asset('icons/blue/castle.svg') }}" alt="icon">
                                <p>{{ $response->vacancy->company }}</p>
                            </div> --}}
                        </a>

                        <a href="/profile/{{ $response->user->id }}" class="elem">
                            @if($response->user->profile->avatar)
                                <div class="cover">
                                    <img src="{{ Storage::url($response->user->profile->avatar) }}" alt="avatar">
                                </div>
                            @else
                                <div class="cover"></div>
                            @endif
                            <p class="response-data">{{ $response->user->name }}</p>
                        </a>

                        @isset($response->cover_letter)
                            <div class="hint-btn square-btn cover-letter-btn" data-letter="{{ $response->cover_letter }}">
                                <img src="{{ asset('icons/gray/newspaper.svg') }}" alt="icon">
                            </div>
                        @endisset
                        
                    </div>

                    <div class="double-btn action-btn">
                        <div class="fill-btn square-btn act-btn-1 {{ $response->status_id == 2 ? 'selected' : '' }}" data-response-id="{{ $response->id }}">
                            <img src="{{ asset('icons/special/x.svg') }}" alt="icon">
                        </div>
                        <div class="fill-btn square-btn act-btn-2 {{ $response->status_id == 3 ? 'selected' : '' }}" data-response-id="{{ $response->id }}">
                            <img src="{{ asset('icons/black/clock.svg') }}" alt="icon">
                        </div>
                        <div class="fill-btn square-btn act-btn-3 {{ $response->status_id == 1 ? 'selected' : '' }}" data-response-id="{{ $response->id }}">
                            <img src="{{ asset('icons/special/checkmark.svg') }}" alt="icon">
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination" style="--i: 3">
            {{ $responses->links('vendor.pagination.custom_pagination') }}
        </div>
        @endif
    </div>
@endsection