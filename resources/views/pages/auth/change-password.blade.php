@extends("layouts.base")
@section("title", "Zmiana hasła")
@section("subtitle", config("app.name"))

@section("content")

<form action="{{ route("login-submit") }}" method="post">
    @csrf

    <p>To hasło jest domyślne. Nie możesz z niego korzystać.</p>

    <x-qqq-input type="password"
        name="password"
        label="Nowe hasło"
        autofocus
    />
    <x-qqq-input type="password"
        name="confirm_password"
        label="Powtórz hasło"
    />

    <x-qqq-button label="Zmień" action="submit" />

</form>

@endsection