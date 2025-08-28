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
        Schema::create('providers', static function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('short_description', 280);
            $table->string('logo');
            $table->foreignUuid('category_id')->constrained('categories')->cascadeOnDelete();

            $table->index(['category_id', 'created_at']);
            $table->index('category_id');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('providers');
    }
};
