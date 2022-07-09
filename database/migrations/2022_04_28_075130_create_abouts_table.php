<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title_about_en');
            $table->string('title_about_tr');
            $table->string('title_about_ru');
            $table->longText('description_about_en');
            $table->longText('description_about_tr');
            $table->longText('description_about_ru');
            $table->string('about_img');
            $table->string('about_img_medium');
            $table->string('about_img_alt');
            $table->integer('about_gable_id');
            $table->string('about_gable_type');
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
        Schema::dropIfExists('abouts');
    }
};
