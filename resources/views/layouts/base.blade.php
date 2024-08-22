<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title") | {{ config('app.name') }}</title>

    <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    @bukStyles(true)
</head>
<body>
    <header>
        <h1>
            @yield("title")
            <small>@yield("subtitle")</small>
        </h1>
    </header>

    <nav>
        @foreach ([
            "Kokpit" => "home",
            "Klienci" => "clients-list",
            "Zlecenia" => "commissions-list",
        ] as $label => $route)  
        <x-qqq-button :action="route($route)" :label="$label" :active="Route::currentRouteName() == $route"/>
        @endforeach
    </nav>

    <main>
        @yield("content")
    </main>

    <footer>
        <h3>{{ config('app.name') }}</h3>
    </footer>

    @bukScripts(true)
</body>
</html>