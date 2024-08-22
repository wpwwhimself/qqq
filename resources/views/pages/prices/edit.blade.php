@extends("layouts.base")
@section("title", $price?->name ?? "Nowa stawka")
@section("subtitle", "Edycja stawki")

@section("content")

<form action="{{ route('prices-submit') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $price?->id }}">
    <x-qqq-input
        name="name"
        label="Nazwa"
        :value="$price?->name"
    />
    <x-qqq-select
        name="client_id"
        label="Klient"
        :value="$client_id ?? $price?->client_id"
        :options="$clients"
    />
    <x-qqq-select
        name="price_type_id"
        label="Wymiar"
        :value="$price?->price_type_id"
        :options="$priceTypes"
    />
    <x-qqq-input type="number" step="0.01" min="0"
        name="price"
        label="Kwota"
        :value="$price?->price"
    />

    <x-qqq-button label="Zapisz"
        action="submit"
    />
    @if ($price)
    <x-qqq-button label="Usuń"
        action="submit"
        name="method" value="DELETE"
        class="danger"
    />
    @endif
</form>

@endsection