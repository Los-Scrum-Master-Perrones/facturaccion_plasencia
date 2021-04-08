<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ClaseProducto extends Migration
{
    public function up()
    {
    Schema::create('clase_productos', function (Blueprint $table) {
        $table->bigIncrements('id_producto');
        $table->string('item');
        $table->integer('id_capa');
        $table->integer('id_vitola');
        $table->integer('id_nombre');    
        $table->integer('id_marca');   
        $table->integer('id_orden');
        $table->integer('id_cello'); 
        $table->integer('id_tipo_empaque');
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
    Schema::dropIfExists('clase_productos');
}
}
