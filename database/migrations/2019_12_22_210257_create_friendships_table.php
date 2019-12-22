<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;

class CreateFriendshipsTable extends Migration
{
    public function up()
    {
        Schema::create(config('friendships.tables.fr_pivot'), function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('sender_type');
            $table->uuid('sender_id');
            $table->string('recipient_type');
            $table->uuid('recipient_id');
            $table->tinyInteger('status')->default(0);
            $table->timestamps();

            $table->index(['sender_type', 'sender_id']);
            $table->index(['recipient_type', 'recipient_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists(config('friendships.tables.fr_pivot'));
    }
}
