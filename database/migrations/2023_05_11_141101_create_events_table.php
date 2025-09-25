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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 150);
            $table->string('partners', 400)->nullable();
            $table->text('description', 150);
            $table->string('location', 200)->nullable();

            $table->dateTime('date_start');
            $table->dateTime('date_end')->nullable();
            $table->boolean('is_Fix');
            $table->string('link')->url()->nullable();
            $table->text('organizer_needs')->nullable();

            $table->foreignId('structure_id');
            $table->foreignId('number_of_participants_id', 100);
            $table->foreignId('user_id');
            $table->foreignId('accessType_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
