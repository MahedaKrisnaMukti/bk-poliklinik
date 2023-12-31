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
        Schema::create('checkup_schedules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('doctor_id')
                ->nullable()
                ->constrained('doctors')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->foreignId('poli_id')
                ->nullable()
                ->constrained('polis')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->enum('day', [
                'Senin',
                'Selasa',
                'Rabu',
                'Kamis',
                'Jumat',
                'Sabtu'
            ])
                ->comment('Hari');

            $table->time('start_time')
                ->comment('Jam mulai');

            $table->time('end_time')
                ->comment('Jam selesai');

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
        Schema::dropIfExists('checkup_schedules');
    }
};
