<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhoneNumberTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phone_number', function (Blueprint $table) {
            $table->id()->unsigned()->autoIncrement()->first();
            $table->string('type', 20)->after('id');
            $table->string('number', 25)->after('type');
            $table->foreignId('person_id')->unsigned()->nullable()->after('number')->constrained();
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
        Schema::dropIfExists('phone_number');
    }
}
