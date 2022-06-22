<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_services', function (Blueprint $table) {
            $table->id();
            $table->integer('invoices_id')->unsigned();
            $table->foreign('invoices_id')->references("id")->on("invoices")->onUpdate('cascade')
            ->onDelete('cascade');;
            $table->string('description');
            $table->integer('amount');
            $table->string('unit');
            $table->integer('unit_price');
            $table->integer('total');
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
        Schema::dropIfExists('work_services');
    }
}
