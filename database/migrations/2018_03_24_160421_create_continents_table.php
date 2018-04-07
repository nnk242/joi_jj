<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContinentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('continents', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->string('name', 255);
            $table->string('name_seo', 255);
            $table->timestamps();
        });

        DB::table('continents')->insert([[
            'user_id' => 1,
            'name' => 'Châu Á',
            'name_seo' => 'chau-a',
        ], [
            'user_id' => 1,
            'name' => 'Châu Âu',
            'name_seo' => 'chau-au',
        ], [
            'user_id' => 1,
            'name' => 'Châu Mỹ',
            'name_seo' => 'chau-my',
        ], [
            'user_id' => 1,
            'name' => 'Châu Úc',
            'name_seo' => 'chau-uc',
        ], [
            'user_id' => 1,
            'name' => 'Châu Phi',
            'name_seo' => 'chau-phi',
        ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('continents');
    }
}
