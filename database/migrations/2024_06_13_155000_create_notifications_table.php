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
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("server_id")->unique();
            $table->foreign("server_id")
                ->references("id")
                ->on("servers")
                ->cascadeOnDelete();
            
            $table->string("telegram_token_id");
            $table->boolean("client_up_down")->default(0);
            $table->boolean("server_up_down")->default(0);
            $table->boolean("secret_created")->default(0);
            $table->boolean("server_reporting")->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifications');
    }
};
