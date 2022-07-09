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
        Schema::create('page_reviews', function (Blueprint $table) {
            $table->id();
            $table->string('title_review_en');
            $table->string('title_review_tr');
            $table->string('title_review_ru');
            $table->text('description_review_en');
            $table->text('description_review_tr');
            $table->text('description_review_ru');
            $table->integer('review_gable_id');
            $table->string('review_gable_type');
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
        Schema::dropIfExists('page_reviews');
    }
};
