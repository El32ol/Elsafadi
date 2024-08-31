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
        Schema::create('freelancers', function (Blueprint $table) {
            $table->foreignId('user_id')
                    ->primary()
                    ->constrained('users')
                    ->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birthday')->nullable();
            $table->text('description')->nullable();
            $table->string('image_path')->nullable();
            $table->enum('gender' , ['male' , 'female'])->nullable();
            $table->boolean('verified')->nullable()->default(0);
            $table->unsignedFloat('salary')->nullable();
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
        Schema::dropIfExists('freelancers');
    }
};
