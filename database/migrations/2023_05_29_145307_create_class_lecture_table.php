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
        Schema::create('class_lecture', function (Blueprint $table) {
            $table->unsignedBigInteger('grade_id');
            $table->unsignedBigInteger('lecture_id');
            $table->integer('order');
            $table->primary(['grade_id','lecture_id']);
            $table->foreign('grade_id')->references('id')->on('grades')->onDelete('cascade');
            $table->foreign('lecture_id')->references('id')->on('lectures')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_lecture');
    }
};
