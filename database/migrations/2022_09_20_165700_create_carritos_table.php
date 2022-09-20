<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
class CreateCarritosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carritos', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('pedido_id');
            $table->string('producto_id');
            $table->string('unidades');
            $table->string('precio');
            $table->foreign('pedido_id')->references('id')->on('pedidos')->onDelete('cascade');
            $table->foreign('producto_id')->references('id')->on('products')->onDelete('cascade');  
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carritos');
    }
}