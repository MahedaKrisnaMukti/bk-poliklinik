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
        Schema::create('poli_registers', function (Blueprint $table) {
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
                ->nullable()
                ->comment('Nomor antrian');

            $table->date('poli_register_date')
                ->comment('Tanggal mendaftar poli');

            $table->text('complaint')
                ->comment('Keluhan');

            $table->enum('status', [
                'Belum Diperiksa',
                'Sudah Diperiksa',
            ])
                ->default('Belum Diperiksa')
                ->comment('Status periksa');

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
        Schema::dropIfExists('poli_registers');
    }
};
