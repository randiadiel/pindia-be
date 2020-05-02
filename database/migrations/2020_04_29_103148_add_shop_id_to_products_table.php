<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddShopIdToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('shop_id')->references('id')->on('shops')->onDelete('cascade');
            $table->string('name');
            $table->integer('price');
            $table->string('description',400);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_shop_id_foreign');
            $table->dropColumn('shop_id');
            $table->dropColumn('name');
            $table->dropColumn('price');
            $table->dropColumn('description');
        });
    }
}
