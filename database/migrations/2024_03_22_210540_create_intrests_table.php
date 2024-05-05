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
        Schema::create('intrests', function (Blueprint $table) {
            $table->id();
            $table->string('type');

<<<<<<< HEAD
            $table->bigInteger('profile_student_id')->unsigned();
            $table->foreign('profile_student_id')->references('id')->on('profile_students')->onDelete('cascade');
=======
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
>>>>>>> origin/khader
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('intrests');
    }
};
