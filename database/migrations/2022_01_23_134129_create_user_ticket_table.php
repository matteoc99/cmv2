<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_ticket', function (Blueprint $table) {
            $table->bigInteger("ticket_id")->unsigned();
            $table->bigInteger("user_id")->unsigned();
            $table->primary(['ticket_id', 'user_id']);
            $table->boolean("seen");
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('ticket_id')->references('id')->on('tickets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_ticket');
    }
}
