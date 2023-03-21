<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string("gender")->after("password")->nullable();
            $table->string("optional_img1")->after("password")->nullable();
            $table->string("optional_img2")->after("password")->nullable();
            $table->string("optional_img3")->after("password")->nullable();
            $table->string("birth_date")->after("password")->nullable();
            $table->string("location")->after("password")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
