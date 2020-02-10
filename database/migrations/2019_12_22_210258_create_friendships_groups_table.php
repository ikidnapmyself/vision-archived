<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class CreateFriendshipsGroupsTable.
 */
class CreateFriendshipsGroupsTable extends Migration
{
    public function up()
    {
        Schema::create(config('friendships.tables.fr_groups_pivot'), function (Blueprint $table) {
            $table->uuid('friendship_id')->primary();
            $table->string('friend_type');
            $table->uuid('friend_id');
            $table->integer('group_id')->unsigned();

            $table->foreign('friendship_id')
                ->references('id')
                ->on(config('friendships.tables.fr_pivot'))
                ->onDelete('cascade');

            $table->unique(['friendship_id', 'friend_id', 'friend_type', 'group_id'], 'unique');
        });
    }

    public function down()
    {
        Schema::dropIfExists(config('friendships.tables.fr_groups_pivot'));
    }
}
