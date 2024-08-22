<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield("title") | {{ config('app.name') }}</title>

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
        <a href="{{ route('clients-list') }}">Klienci</a>
    </nav>

    <main>
        @yield("content")
    </main>

    <footer>
        {{ config('app.name') }}
    </footer>

    @bukScripts(true)
</body>
</html>