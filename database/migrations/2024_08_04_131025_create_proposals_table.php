<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('freelancer_id')->constrained('users' ,'id')->cascadeOnDelete();
            $table->foreignId('project_id')->constrained('projects', 'id')->cascadeOnDelete();
            $table->text('description');
            $table->unsignedFloat('cost');
            $table->unsignedBigInteger('duration');
            $table->enum('duration_unit' , ['day' , 'week' , 'month' , 'year']);
            $table->enum('status' , ['pending' , 'accepted' , 'declined']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('proposals');
    }
};
