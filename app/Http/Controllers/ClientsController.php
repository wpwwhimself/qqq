<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

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
                Client::updateOrCreate(["id" => $rq->id], $rq->except(["_token", "method"]));
        }
        
        return redirect()->route("clients-list");
    }
}
