@extends("layouts.base")
@section("title", "Lista zleceń")

@section("content")

@if (request("client_id"))
<x-qqq-button label="Nowe"
    :action="route('commissions-edit-for-client', ['client_id' => request('client_id')])"
/>
@endif

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nazwa</th>
            <th>Firma</th>
            <th>Status</th>
            <th>Czas pośw.</th>
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
            <td>{{ $commission->total_hours_spent }}</td>
            <td>
                <x-qqq-button label="Edytuj"
                    :action="route('commissions-edit', ['id' => $commission->id])"
                />
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="5" class="ghost">Brak zleceń</td>
        </tr>
        @endforelse
    </tbody>
</table>

@endsection