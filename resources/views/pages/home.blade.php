@extends("layouts.base")
@section("title", "Kokpit")
@section("subtitle", config("app.name"))

@section("content")

<h2>Otwarte zlecenia</h2>

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
        @forelse ($openCommissions as $commission)
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
            <td colspan="4">Brak zleceń na tapecie</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection