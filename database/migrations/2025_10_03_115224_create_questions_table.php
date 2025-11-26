<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');

            $table->string('subject');
            // $table->text('question');
            $table->text('question_text');
            $table->string('option_a');
            $table->string('option_b');
            $table->string('option_c');
            $table->string('option_d');
            $table->string('correct_option');
            
                        
            // $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('subject_id')->nullable()->constrained('subjects')->onDelete('set null');
            // $table->unsignedBigInteger('session_id')->nullable();
            // $table->unsignedBigInteger('term_id')->nullable();
            // $table->timestamps();

            // $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('set null');
            // $table->foreign('session_id')->references('id')->on('sessions')->onDelete('set null');
            // $table->foreign('term_id')->references('id')->on('terms')->onDelete('set null');
        });

        //  Schema::create('options', function (Blueprint $table) {
        //     $table->id();
        //     // $table->unsignedBigInteger('question_id');
        //     $table->foreignId('question_id')->constrained('questions')->onDelete('cascade');
        //     $table->string('option_text');
        //     $table->boolean('is_correct')->default(false);
        //     $table->timestamps();

        //     // $table->foreign('question_id')->references('id')->on('questions')->onDelete('cascade');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('question', function(Blueprint $table){
        //     $table->dropForeign(['subject_id']);
        //     $table->dropForeign(['session_id']);
        //     $table->dropForeign(['term_id']);
        //     $table->dropColumn(['subject_id', 'session_id', 'term_id']);
        // });
        // Schema::dropIfExists('options');
        Schema::dropIfExists('questions');
        // Schema::dropIfExists('questions');
        // Schema::dropIfExists('subject');
        // Schema::dropIfExists('session');
        // Schema::dropIfExists('term');
    }
}
