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
        Schema::create('checkup_details', function (Blueprint $table) {
            $table->id();

            $table->foreignId('checkup_id')
                ->nullable()
                ->constrained('checkups')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('medicine_id')
                ->nullable()
                ->constrained('medicines')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

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
        Schema::dropIfExists('checkup_details');
    }
};
