@extends('layouts.layout')

@section('title', 'отклики')

@section('content')
    <link href="{{asset('css/av-cover.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-list.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/av-form.css?v=').time()}}" rel="stylesheet">
    <link href="{{asset('css/recruiter_responses.css?v=').time()}}" rel="stylesheet">
    {{-- <link href="{{asset('css/av-dropdown.css?v=').time()}}" rel="stylesheet"> --}}

    <script>
        $(document).ready(function() {
            $('.cover-letter-btn').click(function() {
                var letter = $(this).data('letter');
                $('.av-form p').text(letter);
                $('.av-form').fadeIn().css('display', 'flex');
                $('.blur-bg').fadeIn();
            });

            $('.cancel-btn, .x-btn').click(function() {
                $('.av-form').fadeOut();
                $('.letter-form').fadeOut();
                $('.blur-bg').fadeOut();
            });

            var acceptButton = $('.accept-btn');
            var rejectButton = $('.reject-btn');

            $(document).on('click', '.accept-btn', function(e) {
                e.preventDefault();
                var responseId = $(this).data('response-id'); // Получаем id отклика
                setStatus(responseId, 'принят');
            });

            $(document).on('click', '.reject-btn', function(e) {
                e.preventDefault();
                var responseId = $(this).data('response-id'); // Получаем id отклика
                setStatus(responseId, 'отказ');
            });


            // Функция для отправки AJAX-запроса на сервер
            function setStatus(responseId, status) {
                $.ajax({
                    url: '/response/' + responseId + '/set_status',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        status: status
                    },
                    success: function(data) {
                        if (data.success) {
                            // Обновляем статус отклика на странице
                            // var statusElement = $('.set-status-btn[data-response-id="' + responseId + '"]').siblings('.elem').find('.status-text');
                            var statusElement = $('#status-text-' + responseId);
                            statusElement.text(status);

                            // Обновляем класс статуса
                            statusElement.removeClass('stat0 stat1 stat2');
                            if (status == 'не рассмотрено') {
                                statusElement.addClass('stat0');
                            } else if (status == 'принят') {
                                statusElement.addClass('stat1');
                            } else if (status == 'отказ') {
                                statusElement.addClass('stat2');
                            }

                            // Обновляем состояние кнопок
                            var acceptButton = $('.accept-btn[data-response-id="' + responseId + '"]');
                            var rejectButton = $('.reject-btn[data-response-id="' + responseId + '"]');
                            
                            if (status == 'принят') {
                                rejectButton.show();
                                acceptButton.hide();
                            } else if (status == 'отказ') {
                                acceptButton.show();
                                rejectButton.hide();
                            }

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
                <div class="l-row" style="--i: {{ $index + 3}}">
                    <div class="set">

                        <div class="elem">
                            <p class="hint-text">{{ $response->created_at }}</p>
                        </div>
        
                        <div class="elem">
                            <p id="status-text-{{ $response->id }}" class="{{ $response->status == 'не рассмотрено' ? 'stat0' : ($response->status == 'принят' ? 'stat1' : 'stat2') }}">
                                {{ $response->status }}
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

                            <p>{{ $response->vacancy->title }}</p>  

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
                            <p>{{ $response->user->name }}</p>
                        </a>

                        @isset($response->cover_letter)
                            <div class="hint-btn square-btn cover-letter-btn" data-letter="{{ $response->cover_letter }}">
                                <img src="{{ asset('icons/gray/newspaper.svg') }}" alt="icon">
                            </div>
                        @endisset
                        
                    </div>

                    <div class="double-btn">
                        @if ($response->status !== 'отказ')
                        <div class="fill-btn square-btn reject-btn" data-response-id="{{ $response->id }}">
                            <img src="{{ asset('icons/gray/x.svg') }}" alt="icon">
                        </div>
                        @elseif ($response->status !== 'принят')
                        <div class="fill-btn square-btn accept-btn" data-response-id="{{ $response->id }}">
                            <img src="{{ asset('icons/blue/checkmark.svg') }}" alt="icon">
                        </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        <div class="pagination" style="--i: 3">
            {{ $responses->links() }}
        </div>
        @endif
    </div>
@endsection