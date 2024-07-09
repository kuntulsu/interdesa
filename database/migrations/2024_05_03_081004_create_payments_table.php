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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("customer_id");
            $table->unsignedBigInteger("user_id")->nullable();
            $table->unsignedBigInteger("period_id")->nullable();
            $table->foreign("period_id")
                ->references("id")
                ->on("periods")
                ->nullOnDelete();
            $table->foreign("user_id")
                ->references("id")
                ->on("users")
                ->nullOnDelete();
            $table->foreign("customer_id")
                ->references("id")
                ->on("customers")
                ->cascadeOnDelete();
            $table->decimal("amount", 10, 0);
            $table->text("note")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
