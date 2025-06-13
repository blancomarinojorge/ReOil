<?php

use App\Models\Truck;
use App\Models\User;
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
        Schema::create('route', function (Blueprint $table) {
            $table->id();
            $table->integer('state')->default(0);
            $table->string('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('started_at');
            $table->dateTime('finished_at');
            $table->foreignIdFor(User::class, 'id_creator_user');
            $table->foreignIdFor(User::class, 'id_driver_user');
            $table->foreignIdFor(Truck::class);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('route');
    }
};
