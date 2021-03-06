<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_statuses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('invoices_id')->unsigned();
            $table->foreign('invoices_id')->references("id")->on("invoices")->onUpdate('cascade')
            ->onDelete('cascade');
            $table->integer('paid');
            $table->integer('unpaid');
            $table->integer('payment_method');
            $table->integer('status');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice__statuses');
    }
}
