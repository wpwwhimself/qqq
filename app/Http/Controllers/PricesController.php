<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Price;
use App\Models\PriceType;
use Illuminate\Http\Request;

class PricesController extends Controller
{
    private function editFunnel(int $id = null, int $client_id = null)
    {
        $price = $id ? Price::findOrFail($id) : null;
        if ($price)
            $client_id = $price->client_id;

        $clients = Client::orderBy("company_name")
            ->where("id", $client_id)
            ->get()
            ->pluck("id", "company_name");
        $priceTypes = PriceType::all()
            ->pluck("id", "name");

        return view("pages.prices.edit", compact(
            "price",
            "client_id",
            "clients",
            "priceTypes",
        ));
    }

    public function edit(int $id = null)
    {
        return $this->editFunnel(id: $id);
    }
    public function editForClient(int $client_id)
    {
        return $this->editFunnel(client_id: $client_id);
    }

    public function submit(Request $rq)
    {
        switch ($rq->method) {
            case "DELETE":
                Price::findOrFail($rq->id)->delete();
                break;
            default:
                Price::updateOrCreate(["id" => $rq->id], $rq->except(["_token", "method"]));
        }
        
        return ($rq->client_id)
            ? redirect()->route("clients-edit", ["id" => $rq->client_id])
            : redirect()->route("clients-list");
    }
}
