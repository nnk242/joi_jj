<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->references('id')->on('users');
            $table->string('name', 255);
            $table->string('name_seo', 255);
            $table->string('thumbnail', 255)->nullable();
            $table->text('description')->nullable();
            $table->integer('region_id')->references('id')->on('regions')->default(1);
            $table->integer('type_id')->references('id')->on('types')->default(1);
            $table->tinyInteger('status')->default(1);
            $table->text('tag')->nullable();
            $table->text('tag_seo')->nullable();
            $table->integer('view')->default(0);
            $table->timestamps();
        });
        DB::table('groups')->insert([[
            'user_id'=> 1,
            'name' => 'Ảnh cập nhật',
            'name_seo' => 'default',
        ]]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('groups');
    }
}
