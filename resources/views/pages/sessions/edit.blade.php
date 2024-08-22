@extends("layouts.base")
@section("title", $session?->subject ?? "Nowa sesja")
@section("subtitle", "Edycja sesji")

@section("content")

<form action="{{ route('sessions-submit') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $session?->id }}">
    <input type="hidden" name="commission_id" value="{{ $commission_id ?? $session?->commission_id }}">

    <x-qqq-input
        name="subject"
        label="Temat"
        :value="$session?->subject"
    />
    <span>
        @foreach ($subjects as $s)
        <x-qqq-button :label="$s" action="none" onclick="setSubject('{{ $s }}')" />
        @endforeach
    </span>

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

    @if ($session)
    <x-qqq-callout label="Data rozpoczęcia" :value="$session?->created_at" />
    <x-qqq-callout label="Ostatnia zmiana" :value="$session?->updated_at" />
    <x-qqq-callout label="Godzin od ostatniej zmiany" :value="round($session->updated_at->diffInHours(), 2)" />

    <x-qqq-input type="datetime-local"
        name="ended_at"
        label="Data zakończenia"
        :value="$session?->ended_at"
    />
    <span>
        <x-qqq-button label="Wpisz teraz" action="none" onclick="setEndTime(new Date())" />
        <x-qqq-button label="Wyczyść" action="none" onclick="setEndTime()" />
    </span>
    <x-qqq-input type="number" min="0" step="0.01"
        name="hours_spent"
        label="Poświęcony czas (h)"
        :value="$session?->hours_spent ?? 0"
    />
    @endif


    <x-qqq-button label="Wróć"
        :action="route('commissions-edit', ['id' => $commission_id])"
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

<script>
const setSubject = (subject = null) => {
    document.querySelector(`input[name="subject"]`).value = subject
}
const setEndTime = (date = null) => {
    document.querySelector(`input[name="ended_at"]`).value = date?.toISOString().slice(0, 16)
}
</script>

@endsection
