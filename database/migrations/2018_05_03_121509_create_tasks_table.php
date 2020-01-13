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
            $table->uuid('board_id');
            $table->uuid('project_id')->nullable()->default(null);
            $table->string('name', 100);
            $table->text('body')->nullable();
            $table->boolean('flagged')->default(0); // 0: False 1: True
            $table->unsignedInteger('priority')->default(0);
            $table->string('url')->nullable()->default(null);
            $table->string('address')->nullable()->default(null);
            $table->point('location')->nullable()->default(null);
            $table->uuid('created_by');
            $table->uuid('completed_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            /*
             * Indexes
             */
            $table->primary('id');
            $table->index('board_id')->foreign('board_id')->references('id')->on('boards');
            $table->index('project_id')->foreign('project_id')->references('id')->on('projects');
            $table->index('created_by')->foreign('created_by')->references('id')->on('users');
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
