<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('board_id')->nullable();
            $table->string('name');
            $table->unsignedInteger('type');
            $table->dateTime('due')->nullable();
            $table->dateTime('defer')->nullable();
            //$table->boolean('status')->default(0); // 0: Active 1: Completed
            $table->boolean('starred')->default(0); // 0: False 1: True
            $table->boolean('flagged')->default(0); // 0: False 1: True
            $table->boolean('last_action_complete')->default(0); // 0: False 1: True
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            /*
             * Indexes
             */
            $table->primary('id');
            $table->index('board_id');
            $table->foreign('board_id')->references('id')->on('boards');
            $table->index('due');
            $table->index('defer');
            $table->index('starred');
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
        Schema::dropIfExists('projects');
    }
}
