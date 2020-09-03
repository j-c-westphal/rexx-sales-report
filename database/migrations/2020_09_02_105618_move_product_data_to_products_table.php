<?php

use App\Sale;
use App\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class MoveProductDataToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sales = Sale::all();

        foreach ($sales as $sale) {
            $product = Product::firstOrCreate([
                'product_id' => $sale->product_id,
                'product_name' => $sale->product_name,
                'product_price' => $sale->product_price
            ]);

            $sale->product()->associate($product);
            $sale->save();
        }

        Schema::table('sales', function (Blueprint $table) {
            $table->unsignedBigInteger('product_id')->nullable()->change();
            $table->foreign('product_id')->references('id')->on('products')
                ->onDelete('cascade');

            $table->dropColumn('product_name');
            $table->dropColumn('product_price');
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
            $table->text('product_name');
            $table->float('product_price');
        });

        $products = Product::all();

        foreach ($products as $product) {
            foreach ($product->sales()->get() as $sale) {
                $sale->product_id = $product->product_id;
                $sale->product_name = $product->product_name;
                $sale->product_price = $product->product_price;
                $sale->save();
            }
        }

        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['product_id']);
        });

        Schema::table('sales', function (Blueprint $table) {
            $table->integer('product_id')->nullable(false)->change();
        });
    }
}
