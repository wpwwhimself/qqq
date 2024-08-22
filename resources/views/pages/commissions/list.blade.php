@extends("layouts.base")
@section("title", "Lista zleceń")

@section("content")

@if (request("client_id"))
<a href="{{ route("commissions-edit-for-client", ["client_id" => request("client_id")]) }}">Nowe</a>
@endif

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nazwa</th>
            <th>Firma</th>
            <th>Status</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @forelse ($commissions as $commission)
        <tr>
            <td>{{ $commission->id }}</td>
            <td>{{ $commission->name }}</td>
            <td>{{ $commission->client->company_name }}</td>
            <td>{{ $commission->status->name }}</td>
            <td>
                <a href="{{ route("commissions-edit", ["id" => $commission->id]) }}">Edytuj</a>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">Brak zleceń</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection