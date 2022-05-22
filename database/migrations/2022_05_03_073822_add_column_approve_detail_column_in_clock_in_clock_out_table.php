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
        Schema::table('clock_in_clock_out', function (Blueprint $table) {
            $table->string('status')->default('PENDING')->after('roster_id');
            $table->string('comments')->nullable()->after('status');
            $table->foreignId('request_changed_by')->nullable()->after('comments')->constrained('users');
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
            $table->dropColumn('status','remarks','request_changed_by');
        });
    }
};
