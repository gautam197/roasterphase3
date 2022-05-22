<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clock_in_clock_out', function (Blueprint $table) {
            $table->dateTime('status_changed_date_time')->nullable()->after('request_changed_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clock_in_clock_out', function (Blueprint $table) {
            $table->dropColumn('status_changed_date_time');
        });
    }
};
