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
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('author_user_id'); // Felhasználó azonosító
            $table->string('file'); // Fájl neve és elérési útja
            $table->string('file_type'); // Fájl típusa (pl. image/jpeg)
            $table->integer('file_size'); // Fájl mérete bájtokban
            $table->string('password')->nullable(); // Opcióként jelszó
            $table->timestamps(); // Created_at és updated_at mezők
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medias');
    }
};
