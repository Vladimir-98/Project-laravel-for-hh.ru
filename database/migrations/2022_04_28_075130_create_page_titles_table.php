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
        Schema::create('page_titles', function (Blueprint $table) {
            $table->id();
            $table->string('page_title_one_en');
            $table->string('page_title_one_tr');
            $table->string('page_title_one_ru');
            $table->string('page_title_two_en')->nullable();
            $table->string('page_title_two_tr')->nullable();
            $table->string('page_title_two_ru')->nullable();
            $table->string('page_title_three_en')->nullable();
            $table->string('page_title_three_tr')->nullable();
            $table->string('page_title_three_ru')->nullable();
            $table->string('page_title_four_en')->nullable();
            $table->string('page_title_four_tr')->nullable();
            $table->string('page_title_four_ru')->nullable();
            $table->string('page_title_five_en')->nullable();
            $table->string('page_title_five_tr')->nullable();
            $table->string('page_title_five_ru')->nullable();
            $table->integer('page_title_gable_id');
            $table->string('page_title_gable_type');
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
        Schema::dropIfExists('page_titles');
    }
};
