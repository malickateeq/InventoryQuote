<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('quotation_id');
            $table->string('origin')->nullable();
            $table->string('destination')->nullable();
            $table->string('zip')->nullable();
            $table->string('transportation_type')->nullable();
            $table->string('type')->comment('FCL, LCL, AIR')->nullable();
            $table->dateTime('ready_to_load_date', 0)->nullable();
            // $table->dateTimeTz('created_at', 0);
            // $table->timestamp('ready_to_load_date')->nullable();
            $table->string('value_of_goods')->comment('In USD')->nullable();
            $table->string('isStockable')->nullable();
            $table->string('isDGR')->nullable();
            $table->string('calculate_by')->comment('units or shipment')->nullable();
            $table->string('total_weight')->nullable();
            $table->string('quantity')->nullable();
            $table->string('remarks')->nullable();
            $table->string('isClearanceReq')->nullable();
            
            // For Sea+FCL
            $table->string('no_of_containers')->nullable();
            $table->string('container_size')->nullable();
            
            $table->string('l')->nullable();
            $table->string('w')->nullable();
            $table->string('h')->nullable();
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
        Schema::dropIfExists('quotations');
    }
}
