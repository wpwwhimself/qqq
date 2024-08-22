@extends("layouts.base")
@section("title", $client?->name ?? "Nowy klient")
@section("subtitle", "Edycja klienta")

@section("content")

<form action="{{ route('clients-submit') }}" method="post">
    @csrf
    <input type="hidden" name="id" value="{{ $client?->id }}">

    <h2>Dane kontaktowe</h2>
    <x-qqq-input
        name="company_name"
        label="Firma"
        :value="$client?->company_name"
    />
    <x-qqq-input
        name="representative_name"
        label="Reprezentant"
        :value="$client?->representative_name"
    />
    <x-qqq-input type="email"
        name="email"
        label="Adres email"
        :value="$client?->email"
    />
    <x-qqq-input type="tel"
        name="phone"
        label="Numer telefonu"
        :value="$client?->phone"
    />

    @if ($client)

        <h2>Stawki</h2>

        <x-qqq-button label="Nowa"
            :action="route('prices-edit-for-client', ['client_id' => $client->id])"
        />

        <table>
            <thead>
                <tr>
                    <th>Nazwa</th>
                    <th>Kwota</th>
                    <th>Wymiar</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($client->prices as $price)
                <tr>
                    <td>{{ $price->name }}</td>
                    <td>{{ asPln($price->price) }}</td>
                    <td>{{ $price->type->name }}</td>
                    <td>
                        <x-qqq-button label="Edytuj"
                            :action="route('prices-edit', ['id' => $price->id])"
                        />
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="ghost">Brak stawek</td>
                </tr>
                @endforelse
            </tbody>
        </table>

    @endif

    <x-qqq-button label="Zapisz"
        action="submit"
    />
    @if ($client)
    <x-qqq-button label="Usuń"
        action="submit"
        name="method" value="DELETE"
        class="danger"
    />
    @endif
</form>

@endsection