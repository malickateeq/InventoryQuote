<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freights', function (Blueprint $table) 
        {
            $table->id();
            $table->integer('user_id');
            $table->string('origin')->nullable();
            $table->string('destination')->nullable();
            $table->string('transportation_type')->nullable();
            $table->string('type')->comment('FCL, LCL, AIR')->nullable();
            $table->timestamp('ready_to_load_date')->nullable();
            $table->string('value_of_goods')->comment('In USD')->nullable();
            $table->string('isStockable')->nullable();
            $table->string('calculate_by')->comment('units or shipment')->nullable();
            $table->string('gross_vol')->nullable();
            $table->string('cargo_weight')->nullable();
            $table->string('remarks')->nullable();
            $table->string('isClearanceReq')->nullable();
            $table->string('quantity')->nullable();
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
        Schema::dropIfExists('freights');
    }
}
