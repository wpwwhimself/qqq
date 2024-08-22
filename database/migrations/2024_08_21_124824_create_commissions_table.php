<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('commissions', function (Blueprint $table) {
            $table->id();
            $table->foreignId("client_id")->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId("commission_status_id")->default(1)->constrained();
            $table->string("name");
            $table->text("description")->nullable();
            $table->foreignId("price_id")->constrained();
            $table->text("notes")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('commissions');
    }
};
