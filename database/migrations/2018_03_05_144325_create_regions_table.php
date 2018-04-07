<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->string('name', 255);
            $table->string('name_seo', 255);
            $table->text('description')->nullable();
            $table->text('image')->nullable();
            $table->integer('continent_id')->references('id')->on('continents')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->timestamps();
        });
        DB::table('regions')->insert([[
            'user_id'=> 1,
            'name' => 'Việt Nam',
            'name_seo' => 'viet-nam',
            'image' => 'uploads/regions/vietnam.png',
        ],[
            'user_id'=> 1,
            'name' => 'Hàn Quốc',
            'name_seo' => 'han-quoc',
            'image' => 'uploads/regions/korea.png',
        ],[
            'user_id'=> 1,
            'name' => 'Nhật Bản',
            'name_seo' => 'nhat-ban',
            'image' => 'uploads/regions/japan.png',
        ],[
            'user_id'=> 1,
            'name' => 'Trung Quốc',
            'name_seo' => 'trung-quoc',
            'image' => 'uploads/regions/china.png',
        ],[
            'user_id'=> 1,
            'name' => 'Thái Lan',
            'name_seo' => 'thai-lan',
            'image' => 'uploads/regions/thailand.png',
        ],]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regions');
    }
}
