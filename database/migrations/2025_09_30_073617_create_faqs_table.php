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
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('question');
            $table->text('answer');
            $table->string('category'); // Nutrisi, Persalinan, Kondisi Darurat, dll
            $table->string('tags')->nullable(); // Keywords untuk pencarian, comma separated
            $table->integer('trimester')->nullable(); // 1, 2, 3 atau null untuk umum
            $table->boolean('is_featured')->default(false);
            $table->integer('views_count')->default(0);
            $table->integer('helpful_count')->default(0); // jumlah "helpful"
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            
            $table->index(['category', 'trimester']);
            $table->index('is_featured');
            $table->fullText(['question', 'answer', 'tags']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faqs');
    }
};
