<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIntegrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('integrations', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('user_id');
            $table->string('provider_name')->nullable();
            $table->string('provider_id')->unique()->nullable();
            $table->string('access_token')->nullable();
            $table->string('refresh_token')->nullable();
            $table->json('profile');
            $table->timestamp('imported_at')->nullable();
            $table->timestamp('exported_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            /*
             * Indexes
             */
            $table->primary('id');
            $table->unique(['provider_name', 'provider_id']);
            $table->index('user_id')->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('integrations');
    }
}
