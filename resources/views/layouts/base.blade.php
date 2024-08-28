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

    @auth
    <nav>
        @foreach ([
            "Kokpit" => "home",
            "Klienci" => "clients-list",
            "Zlecenia" => "commissions-list",
        ] as $label => $route)
            @unless (!Auth::user()->is_admin && $label == "Klienci")
            <x-qqq-button :action="route($route)" :label="$label" :active="Route::currentRouteName() == $route" />
            @endunless
        @endforeach
    </nav>
    @endauth

    <main>
        @yield("content")
    </main>

    <footer>
        <h3>{{ config('app.name') }}</h3>

        <span class="success">{{ session("success") }}</span>
        <span class="error">{{ session("error") }}</span>

        @auth
        <x-qqq-button label="Wyloguj" :action="route('logout')"/>
        @endauth
    </footer>

    @bukScripts(true)
</body>
</html>