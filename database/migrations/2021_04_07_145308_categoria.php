<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Categoria extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categoria', function (Blueprint $table) {
            $table->bigIncrements('id_categoria');
            $table->String('categoria')->nullable();
            
        $table->timestamps();
        });


        DB::unprepared('insert into categoria(categoria.categoria) values("NEW ROLL")');
        DB::unprepared('insert into categoria(categoria.categoria) values("CATALOGO")');
        DB::unprepared('insert into categoria(categoria.categoria) values("INVENTARIO EXISTENTE")');
        DB::unprepared('insert into categoria(categoria.categoria) values("WAREHOUSE")');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        
        Schema::dropIfExists('categoria');
    }
}
