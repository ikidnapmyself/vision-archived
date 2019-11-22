<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visions', function (Blueprint $table) {
            $table->uuid('id');
            $table->string('name', 100);
            $table->json('body');
            $table->uuid('created_by')->nullable();
            $table->timestamps();
            $table->softDeletes();

            /*
             * Indexes
             */
            $table->primary('id');
            $table->index('created_by');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visions');
    }
}
