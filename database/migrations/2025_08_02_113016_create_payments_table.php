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


            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('examination_id')->nullable()->constrained()->onDelete('set null');

            $table->decimal('amount', 10, 2);
            $table->text('notes')->nullable();

            $table->enum('payment_type', ['consultation', 'glasses']);
            $table->enum('method', ['cash', 'online']);

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
