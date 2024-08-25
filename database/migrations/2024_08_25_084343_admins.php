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
        Schema::create('tbl_admins', function (Blueprint $table) {
            $table->id();
            $table->string('username', 50);
            $table->string('password', 255);
            $table->string('email', 100);
            $table->string('first_name', 50);
            $table->string('last_name', 50);
            $table->integer('role_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbl_admins');
    }
};
