<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commission_statuses', function (Blueprint $table) {
            $table->id();
            $table->string("name");
        });

        DB::table("commission_statuses")->insert([
            ["name" => "nowe"],
            ["name" => "w realizacji"],
            ["name" => "w testach klienta"],
            ["name" => "czeka na wdrożenie"],
            ["name" => "zrealizowane"],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commission_statuses');
    }
};
