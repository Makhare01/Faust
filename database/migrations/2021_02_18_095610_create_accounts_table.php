<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('account_number');
            $table->string('account_type');
            $table->string('country_code');
            $table->string('user_created_id');   
            $table->string('account_login');
            $table->string('account_pwd');
            
            $table->string('ssh_ip');
            $table->float('ssh_port');
            $table->string('ssh_login');
            $table->string('ssh_pwd');
            
            $table->string('country');
            $table->string('city');
            $table->string('zip');
            $table->string('state')->default('N/A');
            $table->timestamp('company_created_date')->nullable();

            $table->string('status')->default('in progress');
            $table->longText('comment')->nullable();

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
        Schema::dropIfExists('accounts');
    }
}
