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
        Schema::create('navigator_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('navigator_id');
            $table->unsignedBigInteger('parent_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('keywords')->nullable();
            $table->string('url');
            $table->string('target')->default('_self');
            $table->string('icon')->nullable();
            $table->timestamps();

            // Idegen kulcs hozzáadása
            $table->foreign('navigator_id')->references('id')->on('navigators')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('navigator_items');
    }
};
