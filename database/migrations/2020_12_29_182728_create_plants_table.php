<?php

use App\Models\Plant;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status')->default(Plant::PLANT_STATUS_PLANTED);
            $table->integer('quantity')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('bed_id')->references('id')->on('beds');
            $table->foreignId('seed_id')->references('id')->on('seeds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plants');
    }
}
