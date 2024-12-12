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
        Schema::create('songs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Название песни');
            $table->string('category')->comment('Категория песни, например поклонение, хвала');
            $table->string('language')->comment('Язык песни, например UA, RU, EN');
            $table->json('youtube_links')->nullable()->comment('Ссылки на YouTube, хранятся в формате JSON');
            $table->text('note')->nullable()->comment('Примечания к песне');
            $table->text('description')->nullable()->comment('Описание песни');
            $table->json('blocks')->nullable()->comment('Блоки с текстами, аккордами или нотами, хранятся в формате JSON');
            $table->boolean('seen')->default(false)->comment('Флаг, была ли песня просмотрена');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('songs');
    }
};
