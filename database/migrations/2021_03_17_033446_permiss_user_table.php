<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class PermissUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permiss_user', function (Blueprint $table) {
            $table->id();
            $table->string('name_permis');
        });

//        DB::table('users')->insert([
//            ['name_permis' => 'Администратор'],
//            ['name_permis' => 'Студент'],
//            ['name_permis' => 'Преподаватель']
//        ]);
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
