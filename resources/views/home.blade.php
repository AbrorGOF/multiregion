<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @if(isset($code))
        <title>{{$districts->where('code', $code)->first()->name}}</title>
    @else
        <title>{{ \App\Enums\MenuEnum::MAIN->label() }}</title>
    @endif


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div id="app">
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav me-auto">

                    @if(isset($code))
                        <li class="nav-item">
                            <a class="nav-link" href="/{{$code}}">{{ __('Главная страница') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/{{$code}}/about">{{ __('Страница о нас') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/{{$code}}/news">{{ __('Страница новости') }}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/">{{ __('Главная страница') }}</a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <main class="py-4">


<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    @if(isset($code))
                        {{$districts->where('code', $code)->first()->name}}
                    @endif
                </div>

                <div class="card-body">
                    @if(in_array($menu, [\App\Enums\MenuEnum::MAIN, \App\Enums\MenuEnum::SHOW]))
                        @php
                            $i = 0;
                        @endphp
                        <table>
                            @forelse($districts as $district)
                                @php
                                    $i ++;
                                @endphp
                            @if($i == 1)
                                <tr>
                            @endif
                                    <td>
                                        <a href="/{{$district->code}}">
                                            @if(isset($code) && $district->code == $code)
                                                <strong>{{$district->name}}</strong>
                                            @else
                                                {{$district->name}}
                                            @endif
                                        </a>
                                    </td>
                            @if($i == 5)
                                </tr>
                                @php
                                    $i = 0;
                                @endphp
                            @endif
                            @empty
                            @endforelse
                        </table>
                    @else
                        lorem text
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
    </main>
</div>
</body>
</html>
