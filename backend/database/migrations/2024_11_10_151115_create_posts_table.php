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
        Schema::create('posts', function (Blueprint $table) {
            $table->integer('id')->primary();
            $table->string('slug', 150);
            $table->string('title', 150);
            $table->text('body');
            $table->string('images', 150);
            $table->integer('views');
            $table->integer('likes');
            $table->integer('dislikes');
            $table->string('status', 150)->default(true);
            $table->timestamp('published_at')->nullable()->useCurrent();
            $table->timestamp('remove_at')->nullable()->useCurrent();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent();   
            $table->foreignId('user_id')->nullable(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
