@extends("layouts.base")
@section("title", "Lista klientów")

@section("content")

<a href="{{ route("clients-edit") }}">Nowy</a>

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
                <a href="{{ route("clients-edit", ["id" => $client->id]) }}">Edytuj</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">Brak klientów</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection