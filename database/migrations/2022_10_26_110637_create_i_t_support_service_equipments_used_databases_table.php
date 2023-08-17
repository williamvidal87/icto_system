<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateITSupportServiceEquipmentsUsedDatabasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('i_t_support_service_equipments_used_databases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('used_id');
            $table->unsignedBigInteger('item_id');
            $table->unsignedBigInteger('itemdes_id');
            $table->bigInteger('qty')->nullable();
            
            $table->foreign('used_id')->references('id')->on('client_i_t_support_services_databases');
            $table->foreign('item_id')->references('id')->on('equipment_sevice_databases');
            $table->foreign('itemdes_id')->references('id')->on('equipment_description_databases');
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
        Schema::dropIfExists('i_t_support_service_equipments_used_databases');
    }
}
