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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string("secret_id");
            $table->string('server_id');
            $table->decimal("nik", 16, 0)->nullable();
            $table->string("nama")->nullable();
            $table->string('alamat')->nullable();
            $table->string('telp')->nullable();
            $table->date('jatuh_tempo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
