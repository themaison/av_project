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
        Schema::create('response_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('status');
            $table->timestamps();
        });

        // Здесь мы добавляем статусы в таблицу
        DB::table('response_statuses')->insert([
            ['status' => 'приглашение'],
            ['status' => 'отказ'],
            ['status' => 'на рассмотрении'],
            ['status' => 'не рассмотрено'],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('response_statuses');
    }
};
