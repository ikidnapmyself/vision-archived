<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name');
            $table->string('mime_type');
            $table->string('path');
            $table->string('source');
            $table->integer('size'); //in byte
            $table->uuid('user_id');
            $table->uuid('morph_id')->nullable();
            $table->string('morph_type');
            $table->timestamps();
            $table->softDeletes();

            $table->primary('id');
            $table->index(['morph_id', 'morph_type']);
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
