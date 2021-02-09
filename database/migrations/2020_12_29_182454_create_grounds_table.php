<?php

use App\Models\Ground;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('grounds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status')->default(Ground::GROUND_DISPONIBLE);
            $table->string('type');
            $table->integer('number_bed')->unsigned()->default(0);
            $table->integer('number_furrow')->unsigned()->default(0);
            $table->integer('number_terrace')->unsigned()->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('garden_id')->references('id')->on('gardens');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('grounds');
    }
}
