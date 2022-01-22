<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddHigherPrecisionToCondominia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('condominia', function (Blueprint $table) {
            $table->decimal("lat",8,6)->change();
            $table->decimal("lng",8,6)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('condominia', function (Blueprint $table) {
            //
        });
    }
}
