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
        Schema::create('debit_and_credit', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('amount');
            $table->date('date');
            $table->enum('status', ['success', 'failure']);
            $table->unsignedBigInteger('related_info_id');
            $table->string('related_info_type');
            $table->foreignId('transaction_type_id')->constrained('transaction_types')->cascadeOnDelete();
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
        Schema::dropIfExists('debit_and_credit');
    }
};
