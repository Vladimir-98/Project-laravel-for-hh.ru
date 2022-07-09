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
        Schema::create('projects_sliders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();
            $table->string('image');
            $table->string('image_medium');
            $table->string('image_alt');
            $table->string('title_en')->nullable();
            $table->string('title_tr')->nullable();
            $table->string('title_ru')->nullable();
            $table->longText('description_en')->nullable();
            $table->longText('description_tr')->nullable();
            $table->longText('description_ru')->nullable();
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
        Schema::dropIfExists('projects_sliders');
    }
};
