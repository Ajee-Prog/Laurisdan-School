<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_results', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('exam_id');
            // $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('student_id');
            // $table->string('subject');
            // $table->integer('score');
            // $table->integer('total');
            // $table->string('term');
            // $table->string('session');
            // $table->timestamps();

            // $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('score')->default(0);
            $table->integer('total_questions')->default(0);
            $table->timestamps();
            $table->foreign('exam_id')->references('id')->on('exams')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exam_results');
    }
}
