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
        Schema::connection('mysql_edu')->create('results', function (Blueprint $table) {
            $table->id();
            $table->string('topic_id');
            $table->string('user_id');
            $table->string('num_correct')->nullable();
            $table->string('num_incorrect')->nullable();
            $table->enum('status', ['PROCESSING', 'FINISHED'])->default('PROCESSING');
            $table->longText('result')->nullable();
            $table->longText('data')->nullable();
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
        Schema::connection('mysql_edu')->dropIfExists('results');
    }
};
