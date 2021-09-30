<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
            //$table->unsignedBigInteger('package_id')->nullable();
        });
/*
        Schema::table('items', function(Blueprint $table){
            $table->foreign('package_id')
            ->references('id')->on('packages')
            ->onDelete('cascade');
        });
*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
}
