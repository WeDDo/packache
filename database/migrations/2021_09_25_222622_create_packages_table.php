<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity_done')->unsigned()->default(0);
            $table->integer('quantity')->unsigned();
            $table->timestamps();
            $table->unsignedBigInteger('item_id')->nullable();
            $table->unsignedBigInteger('order_id')->nullable();
        });

        Schema::table('packages', function(Blueprint $table){
            $table->foreign('item_id')
            ->references('id')->on('items')
            ->onDelete('cascade');

            $table->foreign('order_id')
            ->references('id')->on('orders')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
