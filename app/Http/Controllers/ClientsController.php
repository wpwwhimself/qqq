<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientsController extends Controller
{
    public function list()
    {
        $clients = Client::all()
            ->sort(fn($a, $b) => $b->commissions->first()?->created_at <=> $a->commissions->first()?->created_at);

        return view("pages.clients.list", compact(
            "clients",
        ));
    }

    public function edit(int $id = null)
    {
        $client = $id ? Client::findOrFail($id) : null;

        return view("pages.clients.edit", compact(
            "client",
        ));
    }

    public function submit(Request $rq)
    {
        switch ($rq->method) {
            case "DELETE":
                Client::findOrFail($rq->id)->delete();
                break;
            default:
                $client = Client::updateOrCreate(["id" => $rq->id], $rq->except(["_token", "method"]));
                User::updateOrCreate(["client_id" => $client->id], ["password" => $client->company_name]);
        }
        
        if (isset($client) && $client->prices->count() == 0)
            return redirect()->route("prices-edit-for-client", ["client_id" => $client->id]);
        
        return redirect()->route("clients-list");
    }
}
