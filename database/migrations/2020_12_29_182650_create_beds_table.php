<?php

use App\Models\Bed;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('beds', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('number')->unsigned();
            $table->integer('x')->unsigned();
            $table->integer('y')->unsigned();
            $table->string('status')->default(Bed::BED_DISPONIBLE);
            $table->string('type');
            $table->timestamps();
            $table->softDeletes();

            $table->foreignId('ground_id')->references('id')->on('grounds');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('beds');
    }
}
