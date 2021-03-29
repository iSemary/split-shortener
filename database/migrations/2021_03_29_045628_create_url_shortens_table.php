<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUrlShortensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('url_shortens', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('full_url', '500');
            $table->string('shorten_url', '150')->nullable();
            $table->string('custom_name', '50')->nullable();
            $table->integer('visits')->default(0);
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
        Schema::dropIfExists('url_shortens');
    }
}
