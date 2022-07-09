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
        Schema::create('designs', function (Blueprint $table) {
            $table->id();
            $table->string('title_design_en');
            $table->string('title_design_tr');
            $table->string('title_design_ru');
            $table->string('design_img_one');
            $table->string('design_img_one_alt');
            $table->string('design_img_two');
            $table->string('design_img_two_alt');
            $table->string('design_img_three');
            $table->string('design_img_three_alt');
            $table->string('design_img_four');
            $table->string('design_img_four_alt');
            $table->string('design_img_five');
            $table->string('design_img_five_alt');
            $table->integer('design_gable_id');
            $table->string('design_gable_type');
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
        Schema::dropIfExists('designs');
    }
};
