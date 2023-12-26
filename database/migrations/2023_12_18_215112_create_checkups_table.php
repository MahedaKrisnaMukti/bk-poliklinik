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

            $table->foreignId('polilist_id')
                ->nullable()
                ->constrained('poli_lists')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->dateTime('checkup_datetime')
                ->comment('Tanggal periksa');

            $table->text('note')
                ->comment('Catatan');

            $table->bigInteger('checkup_fee')
                ->comment('Biaya periksa');

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
