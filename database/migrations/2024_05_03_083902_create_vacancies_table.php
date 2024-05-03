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
        Schema::create('vacancies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->cascadeOnUpdate();;
            $table->string('title');
            $table->string('company_name');
            $table->string('city');
            $table->integer('salary_min');
            $table->integer('salary_max');
            $table->integer('experience');
            $table->text('responsibilities')->nullable();
            $table->text('requirements');
            $table->text('conditions')->nullable();
            $table->text('skills')->nullable();
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
        Schema::dropIfExists('vacancies');
    }
};
