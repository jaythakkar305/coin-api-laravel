<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->id();
            $table->string('asset_id')->nullable();
            $table->string('exchange_id');
            $table->string('website');
            $table->string('name');
            $table->string('data_start')->nullable();
            $table->string('data_end')->nullable();
            $table->string('data_quote_start')->nullable();
            $table->string('data_quote_end')->nullable();
            $table->string('data_symbols_count')->nullable();
            $table->string('volume_1hrs_usd')->nullable();
            $table->string('volume_1day_usd')->nullable();
            $table->string('volume_1mth_usd')->nullable();
            $table->text('json_object')->nullable();
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
        Schema::dropIfExists('coins');
    }
}
