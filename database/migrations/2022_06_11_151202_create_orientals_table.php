<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrientalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orientals', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('storeoriental_id');
            $table->bigInteger('patient_id');
            $table->bigInteger('weight_Oriental');
            $table->date('validate_Oriental');
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
        Schema::dropIfExists('orientals');
    }
}
