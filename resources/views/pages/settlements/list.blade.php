@extends("layouts.base")
@section("title", "Rozliczenia ".$client->company_name)
@section("subtitle", config("app.name"))

@section("content")

<table>
    <thead>
        <tr>
            <th>Miesiąc</th>
            <th>Liczba sesji</th>
            <th>Kwota</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($months as $month => $sessions)
        <tr>
            <td>{{ $month }}</td>
            <td>{{ $sessions->count() }}</td>
            <td>{{ asPln($sessions->sum("price")) }}</td>
            <td>
                <x-qqq-button :label="Auth::user()->is_admin ? 'Edytuj' : 'Zobacz'"
                    :action="route('settlements-download', ['client_id' => $client->id, 'month' => $month])"
                />
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="ghost">Brak rozliczeń</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection