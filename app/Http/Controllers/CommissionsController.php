<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Commission;
use App\Models\CommissionSession;
use App\Models\CommissionStatus;
use App\Models\Price;
use Illuminate\Http\Request;

class CommissionsController extends Controller
{
    public function list()
    {
        $commissions = Commission::orderByDesc("created_at")
            ->get()
            ->filter(fn($comm) => request("client_id")
                ? $comm->client_id == request("client_id")
                : true
            );

        return view("pages.commissions.list", compact(
            "commissions",
        ));
    }

    private function editFunnel(int $id = null, int $client_id = null)
    {
        $commission = $id ? Commission::findOrFail($id) : null;
        if ($commission)
            $client_id = $commission->client_id;

        $clients = Client::orderBy("company_name")
            ->get()
            ->pluck("id", "company_name");
        $prices = Price::where("client_id", $commission?->client_id)
            ->get()
            ->pluck("id", "name");
        $commissionStatuses = CommissionStatus::all()
            ->pluck("id", "name");

        return view("pages.commissions.edit", compact(
            "commission",
            "client_id",
            "clients",
            "prices",
            "commissionStatuses",
        ));
    }

    public function edit(int $id = null)
    {
        return $this->editFunnel(id: $id);
    }
    public function editForClient(int $client_id = null)
    {
        return $this->editFunnel(client_id: $client_id);
    }

    public function submit(Request $rq)
    {
        $price_id = null;
        if (empty($rq->id)) {
            $price_id = Client::findOrFail($rq->client_id)->prices->first()->id;
        }

        switch ($rq->method) {
            case "DELETE":
                Commission::findOrFail($rq->id)->delete();
                break;
            default:
                Commission::updateOrCreate(["id" => $rq->id], [ "price_id" => $price_id, ...$rq->except(["_token", "method"])]);
        }
        
        return redirect()->route("commissions-list");
    }

    //////////////////////////

    private function editSessionFunnel(int $id = null, int $commission_id = null)
    {
        $session = $id ? CommissionSession::findOrFail($id) : null;
        if ($session)
            $commission_id = $session->commission_id;

        $commissions = Commission::orderByDesc("id")
            ->where("id", $commission_id)
            ->get()
            ->mapWithKeys(fn($comm) => ["$comm->id. $comm->name" => $comm->id]);

        return view("pages.sessions.edit", compact(
            "session",
            "commission_id",
            "commissions",
        ));
    }

    public function editSession(int $id = null)
    {
        return $this->editSessionFunnel(id: $id);
    }
    public function editSessionForCommission(int $commission_id)
    {
        return $this->editSessionFunnel(commission_id: $commission_id);
    }

    public function submitSession(Request $rq)
    {
        switch ($rq->method) {
            case "DELETE":
                CommissionSession::findOrFail($rq->id)->delete();
                break;
            default:
                CommissionSession::updateOrCreate(["id" => $rq->id], $rq->except(["_token", "method"]));
        }
        
        return ($rq->commission_id)
            ? redirect()->route("commissions-edit", ["id" => $rq->commission_id])
            : redirect()->route("commissions-list");
    }
}
