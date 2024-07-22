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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('language_id');
            $table->unsignedBigInteger('author_user_id');
            $table->integer('views');
            $table->string('name');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('unit');
            $table->integer('stock');
            $table->enum('type', ['ForRent', 'ForSale']);
            $table->decimal('unit_price', 10, 2);
            $table->unsignedBigInteger('media_id')->nullable();
            $table->unsignedBigInteger('media_group_id')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            // Indexek
            $table->index('language_id');
            $table->index('author_user_id');
            $table->index('type');
            $table->index('is_active');
            $table->index('created_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offers');
    }
};
