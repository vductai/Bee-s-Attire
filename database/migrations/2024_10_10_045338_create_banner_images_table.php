<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBannerImagesTable extends Migration
{
    public function up()
    {
        Schema::create('banner_images', function (Blueprint $table) {
            $table->increments('banner_images_id')->primary(); 
            $table->Integer('banner_id');
            $table->string('image_path');
            $table->timestamps();
            
            $table->foreign('banner_id')->references('banner_id')->on('banners')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('banner_images');
    }
}
