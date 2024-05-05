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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();

            $table->text('note');

<<<<<<< HEAD
            $table->bigInteger('profile_student_id')->unsigned();
            $table->foreign('profile_student_id')->references('id')->on('profile_students')->onDelete('cascade');

            $table->bigInteger('profile_teacher_id')->unsigned();
            $table->foreign('profile_teacher_id')->references('id')->on('profile_teachers')->onDelete('cascade');
=======
            $table->bigInteger('student_id')->unsigned();
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('teacher_id')->unsigned();
            $table->foreign('teacher_id')->references('id')->on('users')->onDelete('cascade');
>>>>>>> origin/khader

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notes');
    }
};
