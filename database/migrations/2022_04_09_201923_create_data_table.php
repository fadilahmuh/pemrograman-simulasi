<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('uniq_id')->nullable(false);
            $table->unsignedInteger('users_id')->index();
            $table->string('csvfile')->nullable(false);
            $table->integer('jumlah')->nullable(false);
            $table->string('range')->nullable(false);
            $table->string('random')->nullable(false);
            $table->integer('sum')->nullable(false);
            $table->float('avg')->nullable(false);
            $table->softDeletes();
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
        Schema::dropIfExists('data');
    }
}
