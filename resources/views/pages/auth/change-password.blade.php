@extends("layouts.base")
@section("title", "Zmiana hasła")
@section("subtitle", config("app.name"))

@section("content")

<form action="{{ route("change-password") }}" method="post">
    @csrf

    <p>To hasło jest domyślne. Nie możesz z niego korzystać.</p>

    <x-qqq-input type="password"
        name="password"
        label="Nowe hasło"
        autofocus
    />
    <x-qqq-input type="password"
        name="password_confirmation"
        label="Powtórz hasło"
    />

    <x-qqq-button label="Zmień" action="submit" />

</form>

@endsection
