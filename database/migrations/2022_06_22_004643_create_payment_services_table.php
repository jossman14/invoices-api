<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_services', function (Blueprint $table) {
            $table->id();
            $table->integer('invoices_id')->unsigned();
            $table->foreign('invoices_id')->references("id")->on("invoices")->onUpdate('cascade')
            ->onDelete('cascade');
            $table->string('payment');
            $table->date('due_date');
            $table->integer('invoice_portion');
            $table->integer('payment_amount');

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
        Schema::dropIfExists('payment_services');
    }
}
