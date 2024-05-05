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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();

            $table->text('reason');
            $table->date('date');

<<<<<<< HEAD
            $table->unsignedBigInteger('reporter_id')->nullable();//المبلغ
            $table->string('reporter_type')->nullable();

            $table->unsignedBigInteger('reported_id')->nullable();//المبلغ عنه
            $table->string('reported_type')->nullable();
=======
            $table->bigInteger('reporter_id')->unsigned();
            $table->foreign('reporter_id')->references('id')->on('users')->onDelete('cascade');

            $table->bigInteger('reported_id')->unsigned();//المبلغ عنه
            $table->foreign('reported_id')->references('id')->on('users')->onDelete('cascade');
>>>>>>> origin/khader

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
