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
        Schema::create('checkups', function (Blueprint $table) {
            $table->id();

            $table->foreignId('poli_register_id')
                ->nullable()
                ->constrained('poli_registers')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->bigInteger('checkup_fee')
                ->comment('Biaya periksa');

            $table->text('note')
                ->comment('Catatan');

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
        Schema::dropIfExists('checkups');
    }
};
