<?php

use App\Http\Controllers\ClientsController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PricesController;
use Illuminate\Support\Facades\Route;

Route::controller(HomeController::class)->group(function () {
    Route::get("", "index")->name("home");
});

Route::controller(ClientsController::class)->prefix("clients")->group(function () {
    Route::get("", "list")->name("clients-list");
    Route::get("edit/{id?}", "edit")->name("clients-edit");
    Route::post("submit", "submit")->name("clients-submit");
});

Route::controller(PricesController::class)->prefix("prices")->group(function () {
    Route::get("edit/{id?}", "edit")->name("prices-edit");
    Route::get("edit/for-client/{client_id}", "editForClient")->name("prices-edit");
    Route::post("submit", "submit")->name("prices-submit");
});
