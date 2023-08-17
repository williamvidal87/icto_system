<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkTicketDatabasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_ticket_databases', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('technical_id')->nullable();
            $table->unsignedBigInteger('support_id')->nullable();
            $table->unsignedBigInteger('borrow_id')->nullable();
            $table->string('request_no')->nullable();
            $table->unsignedBigInteger('client_id');
            $table->string('user_office_info')->nullable();// or person incharge
            $table->unsignedBigInteger('status_id')->nullable();
            $table->unsignedBigInteger('personnel_id')->nullable();
            $table->unsignedBigInteger('request_category')->nullable();
            $table->timestamp('date_approve')->nullable();
            $table->string('cancel_reason')->nullable();
            
            $table->foreign('technical_id')->references('id')->on('client_technical_request_databases');
            $table->foreign('support_id')->references('id')->on('client_i_t_support_services_databases');
            $table->foreign('borrow_id')->references('id')->on('client_borrow_equipment_request_databases');
            $table->foreign('client_id')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('personnel_id')->references('id')->on('users');
            $table->foreign('request_category')->references('id')->on('request_categories');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('work_ticket_databases');
    }
}
