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
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->string('title');
            $table->text('description');
            $table->text('excerpt')->nullable();
            $table->string('keywords')->nullable();
            $table->text('content');
            $table->unsignedBigInteger('media_id')->nullable();
            $table->unsignedBigInteger('media_group_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
