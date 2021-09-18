<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostCommentRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_comment_replies', function (Blueprint $table) {
            $table->id();
            $table->UnsignedBigInteger('post_id');
            $table->UnsignedBigInteger('comment_id');
            $table->UnsignedBigInteger('user_id');
            $table->UnsignedBigInteger('reply_user_id');
            $table->UnsignedBigInteger('reply');
            $table->timestamps();
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('comment_id')->references('id')->on('post_comments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('reply_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_comment_replies');
    }
}
