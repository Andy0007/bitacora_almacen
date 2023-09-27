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
        //
        Schema::create('entregas', function (Blueprint $table) {
            $table->id();
            $table->string('pedido')->nullable();
            $table->integer('linea')->nullable();
            $table->string('descripcion')->nullable();
            $table->integer('cantidad')->nullable();
            $table->string('factura')->nullable();
            $table->string('usuario_pedido')->nullable();
            $table->string('usuario_entrega')->nullable();
            $table->unsignedBigInteger('group_id')->default(1);
            $table->foreign('group_id')->references('id')->on('groups');

            $table->string('firma')->nullable();
            $table->string('evidencia')->nullable();
            $table->string('codigo_entrega')->nullable();

            $table->integer('action_by')->nullable();
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
        //
    }
};
