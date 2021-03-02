<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountoffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accountoffers', function (Blueprint $table) {
            $table->bigIncrements('accountoffer_id');
            $table->bigInteger('account_id');
            $table->bigInteger('offer_id');
            $table->bigInteger('user_id');
            $table->string('account');
            $table->string('offer');

            $table->string('status')->nullable();
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
        Schema::dropIfExists('accountoffers');
    }
}
