<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('savings_submissions', function (Blueprint $table) {
            $table->id();

            // Identification
            $table->string('email');

            // Submission lifecycle
            $table->enum('status', ['pending', 'confirmed'])->default('pending');

            // Email confirmation
            $table->string('confirmation_token')->nullable()->unique();
            $table->timestamp('token_expires_at')->nullable();
            $table->timestamp('confirmed_at')->nullable();

            $table->timestamps();

            // Indexes
            $table->index('email');
            $table->index('status');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('savings_submissions');
    }
};
