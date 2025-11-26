<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->string('admission_no')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('gender')->nullable();
            $table->string('phone')->nullable();
            $table->string('state')->nullable();
            $table->string('nationality')->nullable();
            $table->string('address')->nullable();
            $table->string('parent_contact')->nullable();
            $table->string('religion')->nullable();
            $table->string('image')->nullable();

            $table->timestamps();

            $table->index('parent_id');

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('parent_id')->references('id')->on('parents')->onDelete('set null');
            $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null');



        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
