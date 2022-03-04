<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEquipmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable()->default('');
            $table->string('number')->nullable();
            $table->string('avatar')->nullable();
            $table->string('mark', 100)->nullable();
            $table->string('model', 100)->nullable();
            $table->string('schema_label', 100)->nullable();
            $table->integer('production_date')->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('equipment_type')->unsigned()->default(0);
            $table->bigInteger('ratio')->unsigned()->default(0);
            $table->bigInteger('voltage_class')->unsigned()->default(0);
            $table->bigInteger('current_class')->unsigned()->default(0);
            $table->bigInteger('cell_id')->unsigned()->nullable(false);
            $table->foreign('cell_id')
                ->references('id')
                ->on('cells')
                ->onUpdate('cascade')
                ->onDelete('no action');
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
        Schema::dropIfExists('equipments');
    }
}
