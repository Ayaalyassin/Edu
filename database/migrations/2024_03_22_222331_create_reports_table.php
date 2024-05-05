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

            $table->unsignedBigInteger('reporter_id')->nullable();//المبلغ
            $table->string('reporter_type')->nullable();

            $table->unsignedBigInteger('reported_id')->nullable();//المبلغ عنه
            $table->string('reported_type')->nullable();

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
