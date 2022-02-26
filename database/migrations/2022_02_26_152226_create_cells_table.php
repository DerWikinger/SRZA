<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCellsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cells', function (Blueprint $table) {
            $table->id();
            $table->integer('number')->nullable();
            $table->string('name')->nullable(false)->default('new cell');
            $table->string('avatar')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->bigInteger('unit_id')->unsigned()->nullable(false);
            $table->foreign('unit_id')
                ->references('id')
                ->on('units')
                ->onUpdate('cascade')
                ->onDelete('no action');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cells');
    }
}
