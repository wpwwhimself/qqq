<?php

namespace App\Http\Controllers;

use App\Models\Commission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $openCommissions = Commission::whereNot("commission_status_id", 5)
            ->where(fn ($q) => (Auth::user()->is_admin) ? $q : $q->where("client_id", Auth::user()->client_id))
            ->orderByDesc("updated_at")
            ->get();

        return view("pages.home", compact(
            "openCommissions",
        ));
    }
}
