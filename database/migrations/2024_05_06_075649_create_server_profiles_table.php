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
        Schema::create('server_profiles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("server_id");
            $table->foreign("server_id")
                ->references("id")
                ->on("servers")
                ->cascadeOnDelete();
            $table->string("profile_id")->nullable();
            $table->decimal("price", 10, 0)->nullable();
            $table->timestamps();

            $table->unique(["server_id", "profile_id"]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_profiles');
    }
};
