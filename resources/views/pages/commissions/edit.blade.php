@extends("layouts.base")
@section("title", $commission?->name ?? "Nowe zlecenie")
@section("subtitle", "Edycja zlecenia")

@section("content")

<form action="{{ route('commissions-submit') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $commission?->id }}">

    <h2>Dane zlecenia</h2>
    <x-qqq-input
        name="name"
        label="Nazwa"
        :value="$commission?->name"
        :disabled="!Auth::user()->is_admin"
    />
    <x-qqq-input type="TEXT"
        name="description"
        label="Opis"
        :value="$commission?->description"
        :disabled="!Auth::user()->is_admin"
    />
    <x-qqq-select
        name="client_id"
        label="Klient"
        :value="$client_id ?? $commission?->client_id"
        :options="$clients"
        :disabled="!Auth::user()->is_admin"
    />
    
    @if ($commission)

    <x-qqq-select
        name="price_id"
        label="Stawka"
        :value="$commission->price_id"
        :options="$prices"
        :disabled="!Auth::user()->is_admin"
    />
    <x-qqq-select
        name="commission_status_id"
        label="Status"
        :value="$commission?->commission_status_id"
        :options="$commissionStatuses"
        :disabled="!Auth::user()->is_admin"
    />

        <h2>Sesje</h2>

        <x-qqq-callout label="Łączny czas na tym zleceniu" :value="$commission->total_hours_spent" />

        @if (Auth::user()->is_admin)
        <x-qqq-button label="Nowa"
            :action="route('sessions-edit-for-commission', ['commission_id' => $commission->id])"
        />
        @endif

        <table>
            <thead>
                <tr>
                    <th>Temat</th>
                    <th>Czas poświęcony</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($commission->sessions as $session)
                <tr>
                    <td>{{ $session->subject }}</td>
                    <td>{{ $session->hours_spent }}</td>
                    <td>
                        <x-qqq-button label="Edytuj"
                            :action="route('sessions-edit', ['id' => $session->id])"
                        />
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="ghost">Brak sesji</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    @endif

    @if (Auth::user()->is_admin)
    <x-qqq-button label="Zapisz"
        action="submit"
    />
    @if ($commission)
    <x-qqq-button label="Usuń"
        action="submit"
        name="method" value="DELETE"
        class="danger"
    />
    @endif
    @endif
</form>

@endsection