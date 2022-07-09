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
        Schema::create('project_apartment_metas', function (Blueprint $table) {
            $table->id();
            $table->string('title_meta_en')->nullable();
            $table->string('title_meta_tr')->nullable();
            $table->string('title_meta_ru')->nullable();
            $table->longText('description_meta_en');
            $table->longText('description_meta_tr');
            $table->longText('description_meta_ru');
            $table->string('canonical')->nullable();
            $table->integer('meta_gable_id');
            $table->string('meta_gable_type');
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
        Schema::dropIfExists('project_apartment_metas');
    }
};
