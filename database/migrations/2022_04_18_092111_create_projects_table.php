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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedBigInteger('district_id');
            $table->foreign('district_id')->references('id')->on('districts');
            $table->string('name_en');
            $table->string('name_tr');
            $table->string('name_ru');
            $table->date('deadline')->nullable();
            $table->integer('floors')->nullable();
            $table->integer('sea')->nullable();
            $table->integer('gas')->nullable();
            $table->string('layouts')->nullable();
            $table->integer('price')->nullable();
            $table->integer('аidat')->nullable();
            $table->integer('installments')->nullable();
            $table->integer('pool')->nullable();
            $table->integer('sauna')->nullable();
            $table->integer('hammam')->nullable();
            $table->integer('fitness')->nullable();
            $table->integer('relaxation')->nullable();
            $table->integer('barbecue')->nullable();
            $table->integer('sport')->nullable();
            $table->integer('availability')->nullable();
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
        Schema::dropIfExists('projects');
    }
};
