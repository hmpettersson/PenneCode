<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('person', function (Blueprint $table) {
            $table->id()->unsigned()->autoIncrement()->first();
            $table->string('first_name', 250)->after('id');
            $table->string('last_name', 250)->after('first_name');
            $table->string('gender', 10)->nullable()->after('last_name');
            $table->integer('age')->nullable()->after('gender');
            $table->string('street_address', 250)->after('age');
            $table->string('city', 250)->after('street_address');
            $table->string('state', 250)->nullable()->after('city');
            $table->integer('postal_code')->after('state');
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
        Schema::dropIfExists('person');
    }
}
