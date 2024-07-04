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
        Schema::create('rent_logs', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->uuid('book_id');
            $table->timestamp('rent_date')->useCurrent();
            $table->timestamp('return_date')->nullable();
            $table->timestamp('actual_return_date')->nullable();

            // $table->primary(['username', 'book_id']);

            $table->foreign('username')->references('username')->on('users')->onDelete('cascade');
            $table->foreign('book_id')->references('book_code')->on('books')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rent_logs');
    }
};
