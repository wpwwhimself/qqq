<?php

namespace App\Exports;

use App\Models\Client;
use App\Models\CommissionSession;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CommissionSessionsExport implements FromCollection, WithHeadings
{
    public Client $client;

    public function __construct(
        public int $client_id,
        public string $month,
    ) {
        $this->client_id = $client_id;
        $this->client = Client::findOrFail($client_id);
        $this->month = $month;
    }

    public function headings(): array
    {
        return [
            "id",
            "client_id",
            "commission_id",
            "created_at",
            "ended_at",
            "hours_spent",
            "price_id",
            "notes",
        ];
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = CommissionSession::whereHas("commission", fn($q) => $q->where("client_id", $this->client_id))
            ->whereRaw("substr(commission_sessions.created_at, 1, 7) = '$this->month'")
            ->leftJoin("commissions", "commissions.id", "commission_sessions.commission_id")
            ->select([
                "commissions.name as commission_name",
                "commission_sessions.*",
            ])
            ->get();
        dd($data->toArray());
        return $data;
    }
}
