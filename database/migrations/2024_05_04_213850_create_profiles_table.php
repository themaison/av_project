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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->cascadeOnUpdate();
            $table->string('avatar')->nullable();
            $table->text('description')->nullable();
            $table->text('contacts')->nullable();
            $table->text('resume')->nullable();
        });
    }

    /**
     * Run the migrations.
     *
     * @return void
     */  
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
