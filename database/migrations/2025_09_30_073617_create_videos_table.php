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
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('video_url'); // URL YouTube/TikTok
            $table->string('video_type')->default('youtube'); // youtube, tiktok, vimeo
            $table->string('video_id'); // ID video dari platform
            $table->string('thumbnail')->nullable(); // Custom thumbnail
            $table->integer('trimester')->nullable(); // 1, 2, 3
            $table->string('category'); // Nutrisi, Olahraga, dll
            $table->integer('duration')->nullable(); // durasi dalam detik
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->boolean('is_featured')->default(false);
            $table->integer('views_count')->default(0);
            $table->timestamps();
            
            $table->index(['trimester', 'category']);
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
