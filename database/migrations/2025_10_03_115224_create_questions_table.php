<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{

    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');

            $table->string('subject')->nullable();
            // $table->text('question');
            $table->enum('type', ['mcq', 'fill', 'true_false'])->default('mcq');
            $table->string('correct_answer')->nullable(); // for fill-in
            $table->text('question_text');
            $table->string('option_a')->nullable();
            $table->string('option_b')->nullable();
            $table->string('option_c')->nullable();
            $table->string('option_d')->nullable();
            $table->string('correct_option')->nullable();


            // $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable()->constrained('subjects')->onDelete('set null');
            $table->unsignedBigInteger('session_id')->nullable();
            $table->unsignedBigInteger('term_id')->nullable();
            $table->timestamps();

            // $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('set null');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('set null');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('set null');
        });


    }


    public function down()
    {

        // Schema::dropIfExists('options');
        Schema::dropIfExists('questions');

    }
}
