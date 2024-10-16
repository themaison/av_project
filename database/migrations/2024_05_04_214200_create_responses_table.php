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
        Schema::create('responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->cascadeOnUpdate();
            $table->foreignId('vacancy_id')->constrained()->onDelete('cascade')->cascadeOnUpdate();
            $table->text('cover_letter')->nullable();
            $table->foreignId('status_id')->default(4)->constrained('response_statuses')->onDelete('set default')->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('responses');
    }
};
