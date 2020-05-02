<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangingProductTypeIdInProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign('products_productType_id_foreign');
            $table->renameColumn('productType_id','brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
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
            $table->dropForeign('products_brand_id_foreign');
            $table->renameColumn('brand_id','productType_id');
            $table->foreign('productType_id')->references('id')->on('product_types')->onDelete('cascade');
        });
    }
}
