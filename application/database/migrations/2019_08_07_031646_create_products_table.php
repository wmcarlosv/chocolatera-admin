<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('product_type_id')->unsigned();
            $table->string('name',120)->nullable(false);
            $table->text('description')->nullale();
            $table->float('price')->nullable(false)->default(0.0);
            $table->string('image',100)->nullable();
            $table->timestamps();

            $table->foreign('product_type_id')->references('id')->on('product_types')->onUpdate('restrict')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
