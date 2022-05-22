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
        Schema::create('clock_in_clock_out', function (Blueprint $table) {
            $table->id();
//            $table->foreignId('user_id')->constrained('users');
            $table->jsonb('clock_in_clock_out');
            $table->foreignId('roster_id')->constrained('rosters');
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
        Schema::dropIfExists('clock_in_clock_out');
    }
};
