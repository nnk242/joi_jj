<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->string('name', 255);
            $table->string('name_seo', 255);
            $table->timestamps();
        });

        DB::table('types')->insert([[
            'user_id'=> 1,
            'name' => 'Ảnh xxx',
            'name_seo' => 'anh-xxx',
        ],[
            'user_id'=> 1,
            'name' => 'Ảnh phá trinh',
            'name_seo' => 'anh-pha-trinh',
        ],[
            'user_id'=> 1,
            'name' => 'Ảnh loạn luân',
            'name_seo' => 'anh-loan-luan',
        ],[
            'user_id'=> 1,
            'name' => 'Ảnh sex ma',
            'name_seo' => 'anh-sex-ma',
        ],[
            'user_id'=> 1,
            'name' => 'Ảnh thủ dâm',
            'name_seo' => 'anh-thu-dam',
        ],[
            'user_id'=> 1,
            'name' => 'Ảnh học sinh',
            'name_seo' => 'anh-hoc-sinh',
        ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('types');
    }
}
