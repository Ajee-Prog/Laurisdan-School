<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exams', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('teacher_id')->nullable();
            $table->unsignedBigInteger('class_id')->nullable();
            $table->string('title');
            $table->string('subject')->nullable();
            $table->integer('duration')->default(30); // minutes
            
            $table->string('term')->nullable();
            $table->string('session')->nullable();
            $table->date('exam_date')->nullable();
            $table->boolean('is_active')->default(1);
            // $table->unsignedBigInteger('class_id')->nullable();
            // $table->foreignId('teacher_id')->constrained('teachers')->onDelete('cascade');
            // $table->foreignId('class_id')->constrained('classrooms')->onDelete('cascade');
            
            // $table->unsignedBigInteger('term_id')->nullable();
            // $table->date('date');
            // $table->integer('duration');
            // $table->integer('total_marks');
            
            // $table->foreignId('term_id')->nullable();
            
            // $table->unsignedBigInteger('teacher_id');
            // $table->unsignedBigInteger('class_id');
            // $table->string('title');
            // $table->string('subject');
            // $table->string('term');
            // $table->string('session');
            $table->timestamps();

            // $table->index('teacher_id');
            // $table->index('class_id');

            $table->foreign('teacher_id')->references('id')->on('teachers')->onDelete('set null');
            // $table->foreign('class_id')->references('id')->on('school_classes')->onDelete('cascade');

            $table->foreign('class_id')->references('id')->on('classes')->onDelete('set null');
            // $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('exams');
    }
}
