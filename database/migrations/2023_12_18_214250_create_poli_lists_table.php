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
        Schema::create('poli_lists', function (Blueprint $table) {
            $table->id();

            $table->foreignId('patient_id')
                ->nullable()
                ->constrained('patients')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('checkup_schedule_id')
                ->nullable()
                ->constrained('checkup_schedules')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->bigInteger('queue_number')
                ->comment('Nomor antrrian');

            $table->text('complaint')
                ->comment('Keluhan');

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
        Schema::dropIfExists('poli_lists');
    }
};
