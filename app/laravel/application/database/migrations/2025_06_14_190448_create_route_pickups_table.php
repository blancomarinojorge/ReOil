<?php

use App\Models\Client;
use App\Models\Route;
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
        Schema::create('route_pickups', function (Blueprint $table) {
            $table->id();
            $table->integer('state');
            $table->string('delivery_note_notes')->nullable();
            $table->string('observations')->nullable();
            $table->integer('order');
            $table->json('signature')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->foreignIdFor(Route::class);
            $table->foreignIdFor(Client::class);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route_pickups');
    }
};
