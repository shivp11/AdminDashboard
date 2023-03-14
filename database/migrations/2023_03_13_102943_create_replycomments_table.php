<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReplycommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replycomments', function (Blueprint $table) {
            $table->id('reply_comment_id');
            $table->integer('comment_id');
            $table->integer('post_id');
            $table->string('reply_comment_author');
            $table->string('reply_comment_email');
            $table->text('reply_comment_content');
            $table->string('reply_comment_status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replycomments');
    }
}
