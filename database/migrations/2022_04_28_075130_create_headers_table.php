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
        Schema::create('headers', function (Blueprint $table) {
            $table->id();
            $table->string('title_header_en');
            $table->string('title_header_tr');
            $table->string('title_header_ru');
            $table->longText('description_header_en');
            $table->longText('description_header_tr');
            $table->longText('description_header_ru');
            $table->string('header_img');
            $table->string('header_img_medium');
            $table->string('header_img_alt');
            $table->integer('header_gable_id');
            $table->string('header_gable_type');
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
        Schema::dropIfExists('headers');
    }
};
