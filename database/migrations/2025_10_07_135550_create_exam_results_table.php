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
            $table->unsignedBigInteger('subject_id');
            // $table->integer('score');
            // $table->integer('total');
            $table->unsignedBigInteger('term_id');
            $table->unsignedBigInteger('session_id');
            // $table->timestamps();

            // $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->integer('ca_score')->nullable()->default(0);
            $table->integer('test_score')->default(0);
            $table->integer('exam_score')->default(0);
            // $table->integer('total_score')->default(0);
            $table->integer('total_questions')->default(0);
            $table->integer('total')->default(0);
            // $table->integer('percentage')->default(0);
            $table->decimal('percentage',5 ,2)->default(0);

            $table->string('grade')->nullable();
            $table->string('status')->default('FAIL');
            $table->timestamp('started_at')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->boolean('is_submitted')->default(false);
            $table->string('psychomotor')->nullable();
            $table->string('teacher_comment')->nullable();
            $table->timestamps();

             $table->index('term_id');
                $table->index('session_id');
                $table->index('subject_id');

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
