<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannersTable extends Migration
{
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->unsignedBigInteger('banner_id')->primary();
            $table->string('banner_subtitle');
            $table->string('banner_title');
            $table->text('banner_description');
            $table->string('banner_image');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('banners');
    }
}

