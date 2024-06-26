<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {       
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('website_name')->nullable();
            $table->string('website_url')->nullable();
            $table->string('page_title')->nullable();
            $table->string('meta_keyword',500)->nullable();
            $table->string('meta_description',500)->nullable();

            $table->string('address',500)->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();

            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
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
        Schema::dropIfExists('settings');
    }
};
