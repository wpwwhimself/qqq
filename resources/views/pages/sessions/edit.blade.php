@extends("layouts.base")
@section("title", $session?->name ?? "Nowa sesja")
@section("subtitle", "Edycja sesji")

@section("content")

<form action="{{ route('sessions-submit') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $session?->id }}">

    <x-qqq-input
        name="subject"
        label="Temat"
        :value="$session?->subject"
    />
    <x-qqq-select
        name="commission_id"
        label="Zlecenie"
        :value="$commission_id ?? $session?->commission_id"
        :options="$commissions"
    />
    <x-qqq-input type="TEXT"
        name="description"
        label="Opis"
        :value="$session?->description"
    />
    <x-qqq-input type="TEXT"
        name="notes"
        label="Notatki"
        :value="$session?->notes"
    />
    
    <x-qqq-callout label="Data rozpoczęcia" :value="$session?->created_at" />
    <x-qqq-input type="datetime-local"
        name="ended_at"
        label="Data zakończenia"
        :value="$session?->ended_at"
    />
    <x-qqq-input type="number" min="0" step="0.01"
        name="hours_spent"
        label="Poświęcony czas (h)"
        :value="$session?->hours_spent ?? 0"
    />

    <x-qqq-button label="Zapisz"
        action="submit"
    />
    @if ($session)
    <x-qqq-button label="Usuń"
        action="submit"
        name="method" value="DELETE"
        class="danger"
    />
    @endif
</form>

@endsection