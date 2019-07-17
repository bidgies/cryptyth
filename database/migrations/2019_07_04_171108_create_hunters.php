<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHunters extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hunters', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 500)->default('');
            $table->string('handle', 500)->default('');
            $table->boolean('npc')->default(false);
            $table->timestamps();
        });

        Schema::create('user_hunters', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('hunter_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('hunter_id')->references('id')->on('hunters');
        });

        Schema::create('stats', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200);
            $table->timestamps();
        });

        Schema::create('hunter_stats', function (Blueprint $table) {
            $table->bigInteger('hunter_id')->unsigned();
            $table->bigInteger('stat_id')->unsigned();
            $table->integer('value');
            $table->timestamps();

            $table->foreign('hunter_id')->references('id')->on('hunters');
            $table->foreign('stat_id')->references('id')->on('stats');
        });

        Schema::create('occupations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 500);
            $table->timestamps();
        });

        Schema::create('hunter_occupations', function (Blueprint $table) {
            $table->bigInteger('hunter_id')->unsigned();
            $table->bigInteger('occupation_id')->unsigned();
            $table->timestamps();

            $table->foreign('hunter_id')->references('id')->on('hunters');
            $table->foreign('occupation_id')->references('id')->on('occupations');
        });

        Schema::create('departments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 200);
            $table->timestamps();
        });

        Schema::create('user_departments', function (Blueprint $table) {
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('department_id')->unsigned();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('department_id')->references('id')->on('departments');
        });

        Schema::create('join_codes', function (Blueprint $table) {
          $table->bigIncrements('id');
          $table->string('code', 500);
          $table->bigInteger('user_id')->unsigned();
          $table->bigInteger('used_by')->unsigned()->nullable();
          $table->timestamps();

          $table->foreign('user_id')->references('id')->on('users');
          $table->foreign('used_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('join_codes');
        Schema::dropIfExists('user_departments');
        Schema::dropIfExists('departments');
        Schema::dropIfExists('hunter_occupations');
        Schema::dropIfExists('occupations');
        Schema::dropIfExists('hunter_stats');
        Schema::dropIfExists('stats');
        Schema::dropIfExists('user_hunters');
        Schema::dropIfExists('hunters');
    }
}
