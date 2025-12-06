<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('student_id');
            // $table->string('term');
            // $table->string('session');
            // $table->integer('amount');
            // $table->timestamps();
            $table->unsignedBigInteger('student_id');
            $table->string('session');
            $table->string('term');
            $table->string('class');
            $table->integer('amount');
            $table->integer('amount_paid');
            $table->integer('balance');
            $table->string('payment_method')->nullable();
            $table->date('payment_date')->nullable();
            $table->timestamps();

            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fees');
    }
}
