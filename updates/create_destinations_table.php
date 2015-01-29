<?php namespace Mohsin\Radar\Updates;

use Schema;
use October\Rain\Database\Updates\Migration;

class CreateDestinationsTable extends Migration
{

    public function up()
    {
        Schema::create('mohsin_radar_destinations', function($table)
        { // Based on https://developers.google.com/maps/articles/phpsqlajax_v3#createtable
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 60);
            $table->string('address', 80);
            $table->double('lat', 10, 6);
            $table->double('lng', 10, 6);
            $table->string('addr', 80);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('mohsin_radar_destinations');
    }

}
