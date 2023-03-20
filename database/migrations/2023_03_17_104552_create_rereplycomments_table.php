<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRereplycommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rereplycomments', function (Blueprint $table) {
            $table->id('rereply_comment_id');
            $table->integer('reply_comment_id');
            $table->integer('comment_id');
            $table->integer('post_id');
            $table->string('rereply_comment_author');
            $table->string('rereply_comment_email');
            $table->text('rereply_comment_image');
            $table->string('rereply_comment_content');
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
        Schema::dropIfExists('rereplycomments');
    }
}
