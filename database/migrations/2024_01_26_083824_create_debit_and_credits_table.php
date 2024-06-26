<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('debit_and_credits', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('amount');
            $table->date('date');
            $table->string('related_info_type');
            $table->unsignedBigInteger('related_info_id');
            $table->foreignId('transaction_type_id')->references('id')->on('transaction_type')->onDelete('cascade');
            $table->foreignId('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('debit_and_credits');
    }
};
