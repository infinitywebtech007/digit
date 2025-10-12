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
        Schema::create('calls', function (Blueprint $table) {
            $table->id();
            $table->string('call_id')->nullable();
            $table->string('type')->nullable();
            $table->date('date')->nullable();
            $table->foreignId('party_id')->nullable()->constrained('parties')->onDelete('set null');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');  // Call Taken by
            $table->text('reported_problem')->nullable();
            $table->text('action_taken')->nullable();
            $table->string('status')->nullable();
            $table->date('next_follow_up_date')->nullable();
            $table->string('priority')->nullable();

            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};
