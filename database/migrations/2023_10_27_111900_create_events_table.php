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
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->text('event');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
             //->onDelete("cascade")->onUpdate("cascade");
            $table->unsignedBigInteger('emotion_id');
            $table->foreign('emotion_id')->references('id')->on('emotions');
             //->onDelete("cascade")->onUpdate("cascade");
            $table->text('description');
            $table->smallInteger('deleted');
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
