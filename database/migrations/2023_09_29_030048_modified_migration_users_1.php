<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     * Nama     : Davin Wahyu Wardana
     * NIM      : 6706223003
     * Kelas    : 4603
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 100);
            $table->string('address', 1000);
            $table->string('phoneNumber', 20);
            $table->date('birthdate')->nullable();
            $table->renameColumn('name', 'fullname');
            $table->string('email')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
        });
    }
};