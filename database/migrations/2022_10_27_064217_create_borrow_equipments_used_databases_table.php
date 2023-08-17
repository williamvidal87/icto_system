<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowEquipmentsUsedDatabasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrow_equipments_used_databases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('used_id');
            $table->unsignedBigInteger('device_id');
            $table->bigInteger('qty')->nullable();
            
            $table->foreign('used_id')->references('id')->on('client_borrow_equipment_request_databases');
            $table->foreign('device_id')->references('id')->on('inventory_equipment_databases');
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
        Schema::dropIfExists('borrow_equipments_used_databases');
    }
}
