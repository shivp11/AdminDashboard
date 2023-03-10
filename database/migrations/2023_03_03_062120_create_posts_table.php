<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('post_category_id')->nullable();
            $table->string('post_title');
            $table->string('post_author');
            $table->date('post_date')->timestamps();
            $table->text('post_image');
            $table->text('post_content');
            $table->string('post_comment_count');
            $table->string('post_status');
            $table->integer('post_views_count');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
