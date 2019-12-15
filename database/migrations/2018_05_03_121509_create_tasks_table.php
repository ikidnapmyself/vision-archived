<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('project_id')->nullable();
            $table->string('name', 100);
            $table->text('body')->nullable();
            $table->boolean('flagged')->default(0); // 0: False 1: True
            $table->unsignedInteger('order')->default(1);
            $table->uuid('completed_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            /*
             * Indexes
             */
            $table->primary('id');
            $table->index('project_id')->foreign('project_id')->references('id')->on('projects');
            $table->index('completed_by')->foreign('completed_by')->references('id')->on('assignees');
            $table->index('flagged');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
