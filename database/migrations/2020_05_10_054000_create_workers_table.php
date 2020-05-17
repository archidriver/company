<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('workers', function (Blueprint $table) {
                $table->id();
                $table->string('name', 40); //фио
                $table->string('position_id');
                $table->date('date_start');
                $table->decimal('salary', 8, 2)->nullable();
                $table->integer('level');
                $table->integer('manager_id')->nullable();
                $table->string('image')->nullable();
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
        Schema::dropIfExists('workers');
    }
}
