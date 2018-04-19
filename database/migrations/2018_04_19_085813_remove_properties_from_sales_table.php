<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemovePropertiesFromSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign('sales_product_id_foreign');
            $table->dropColumn(['product_id','quantity']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->unsignedInteger('product_id')->after('code');
            $table->integer('quantity')->after('product_id')->default(0);

            $table->foreign('product_id')
                ->references('id')
                ->on('products');
        });
    }
}
