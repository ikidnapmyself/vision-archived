<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefinitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('definitions', function (Blueprint $table) {
            $table->uuid('id');
            $table->boolean('type'); // 0 => 'project', 1 => 'document'
            $table->string('name');
            $table->text('body');
            $table->timestamps();
            $table->softDeletes();

            /*
             * Indexes
             */
            $table->primary('id');
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('definitions');
    }
}
