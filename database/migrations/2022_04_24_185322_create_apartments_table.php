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
        Schema::create('apartments', function (Blueprint $table) {
            $table->id();
//            $table->string('name_en');
//            $table->string('name_tr');
//            $table->string('name_ru');
            $table->integer('project_id');
            $table->unsignedBigInteger('city_id');
            $table->foreign('city_id')->references('id')->on('cities');
            $table->unsignedBigInteger('district_id');
            $table->foreign('district_id')->references('id')->on('districts');
//            $table->integer('property_type')->nullable();
            $table->date('age')->nullable();
            $table->integer('quadrature')->nullable();
            $table->integer('status')->nullable();
            $table->integer('floor')->nullable();
            $table->integer('floors')->nullable();
            $table->integer('sea')->nullable();
            $table->integer('gas')->nullable();
            $table->integer('layout')->nullable();
            $table->integer('price')->nullable();
            $table->integer('аidat')->nullable();
            $table->integer('balcony')->nullable();
            $table->integer('bathroom')->nullable();
            $table->integer('bedroom')->nullable();
            $table->integer('kitchen')->nullable();
            $table->integer('furniture')->nullable();
            $table->integer('pool')->nullable();
            $table->integer('sauna')->nullable();
            $table->integer('hammam')->nullable();
            $table->integer('fitness')->nullable();
            $table->integer('relaxation')->nullable();
            $table->integer('barbecue')->nullable();
            $table->integer('sport')->nullable();

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
        Schema::dropIfExists('apartments');
    }
};
