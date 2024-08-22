<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $openCommissions = Commission::whereNot("commission_status_id", 5)
            ->orderByDesc("updated_at")
            ->get();

        return view("pages.home", compact(
            "openCommissions",
        ));
    }
}
