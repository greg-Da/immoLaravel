<?php

use App\Models\City;
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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::table('properties', function (Blueprint $table) {
            $table->foreignIdFor(City::class)->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
        
        // SQLITE doesn't support dropping foreign keys I need to drop the whole table
        // Schema::table('propperties', function (Blueprint $table) {
        //     $table->dropForeignIdFor(Property::class);
        // });
        Schema::dropIfExists('properties');
    }
};
