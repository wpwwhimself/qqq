@extends("layouts.base")
@section("title", "Logowanie")
@section("subtitle", config("app.name"))

@section("content")

<form action="{{ route("login-submit") }}" method="post">
    @csrf

    <x-qqq-input type="password"
        name="password"
        label="Hasło"
        autofocus
    />

    <x-qqq-button label="Zaloguj" action="submit" />

</form>

@endsection