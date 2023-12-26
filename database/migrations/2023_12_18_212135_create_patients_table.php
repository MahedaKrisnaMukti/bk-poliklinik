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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('name')
                ->comment('Nama pasien');

            $table->string('address')
                ->comment('Alamat');

            $table->string('identity_card_number')
                ->unique()
                ->comment('Nomor KTP');

            $table->string('phone_number')
                ->comment('Nomor HP');

            $table->string('medical_record_number')
                ->nullable()
                ->comment('Nomor rekam medis');

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
        Schema::dropIfExists('patients');
    }
};
