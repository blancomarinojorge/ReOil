<?php

use App\Models\Container;
use App\Models\Residue;
use App\Models\RoutePickup;
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
        Schema::create('pickup_residue_containers', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(RoutePickup::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Residue::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Container::class)->constrained()->cascadeOnDelete();

            $table->float('quantity');
            $table->string('notes')->nullable();
            $table->dateTime('pickup_time')->nullable();
            $table->boolean('should_pickup_container')->default(true);

            $table->unique(['route_pickup_id','residue_id', 'container_id'],'route_residue_container_unique');

            //added an index to route_pickup_id as im going to query mainly on this column
            $table->index('route_pickup_id');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pickup_residue_containers');
    }
};
