@extends("layouts.base")
@section("title", "Lista klientów")

@section("content")

<x-qqq-button label="Nowy"
    :action="route('clients-edit')"
/>

<table>
    <thead>
        <tr>
            <th>Firma</th>
            <th>Reprezentant</th>
            <th>Stawki</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($clients as $client)
        <tr>
            <td>{{ $client->company_name }}</td>
            <td>{{ $client->representative_name }}</td>
            <td>{{ $client->prices->count() }}</td>
            <td>
                <x-qqq-button label="Zlecenia"
                    :action="route('commissions-list', ['client_id' => $client->id])"
                />
                <x-qqq-button label="Edytuj"
                    :action="route('clients-edit', ['id' => $client->id])"
                />
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="ghost">Brak klientów</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection