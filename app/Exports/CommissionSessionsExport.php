<?php

namespace App\Exports;

use App\Models\Client;
use App\Models\CommissionSession;
use Maatwebsite\Excel\Concerns\FromCollection;

class CommissionSessionsExport implements FromCollection
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

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return CommissionSession::whereHas("commission", fn($q) => $q->where("client_id", $this->client_id))
            ->whereRaw("substr(created_at, 1, 7) = '$this->month'")
            ->get();
    }
}
