<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_comments', function (Blueprint $table) {
            $table->bigIncrements('comment_id');
            $table->string('comment');
            $table->timestamp('date_created')->useCurrent();
            $table->timestamp('date_updated')->useCurrent();

            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('user_id');
            
            $table->foreign('account_id')->references('id')->on('accounts');
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
        Schema::dropIfExists('account_comments');
    }
}
