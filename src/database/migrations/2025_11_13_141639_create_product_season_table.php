<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('product_season', function (Blueprint $table) {
            $table->id(); // bigint unsigned, primary key
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // products(id)
            $table->foreignId('season_id')->constrained('seasons')->onDelete('cascade'); // seasons(id)
            $table->timestamps(); // created_at, updated_at
        });
    }

    public function down(): void {
        Schema::dropIfExists('product_season');
    }
};
