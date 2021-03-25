<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TestQuestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('test_quest', function (Blueprint $table) {
            $table->id();
            $table->integer('id_test');
            $table->string('name_quest');
            $table->string('numb_quest');
            $table->string('ask1');
            $table->string('ask2');
            $table->string('ask3');
            $table->string('ask4');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
