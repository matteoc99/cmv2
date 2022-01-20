<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("title");
            $table->string("desc");
            $table->decimal("price")->nullable();
            $table->bigInteger("nrFattura")->nullable();
            $table->date("estimated")->nullable();
            $table->bigInteger('urgency_id')->unsigned()->nullable();
            $table->foreign('urgency_id')->references('id')->on('urgencies');
            $table->bigInteger('tag_id')->unsigned()->nullable();
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->bigInteger('status_id')->unsigned()->nullable();
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->bigInteger('family_id')->unsigned()->nullable();
            $table->foreign('family_id')->references('id')->on('families');
            $table->bigInteger('craftsman_id')->unsigned()->nullable();
            $table->foreign('craftsman_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
