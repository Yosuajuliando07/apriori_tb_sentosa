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
        Schema::create('aturan_asosiasi_2_items', function (Blueprint $table) {
            $table->id();
            $table->string('rule', 255);
            $table->tinyInteger('total_ab');
            $table->tinyInteger('total_antecedent');
            $table->tinyInteger('total_consequent');
            $table->string('antecedent_text', 100);
            $table->string('consequent_text', 100);
            $table->string('lift_ratio_text', 20);
            $table->float('support_persen');
            $table->float('confidence_persen');
            $table->unsignedBigInteger('hitung_id');
            $table->foreign('hitung_id')->references('id')->on('hitung')->onDelete('cascade');
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
        Schema::dropIfExists('aturan_asosiasi_2_items');
    }
};
