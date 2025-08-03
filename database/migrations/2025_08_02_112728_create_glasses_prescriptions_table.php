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
        Schema::create('glasses_prescriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('examination_id')->constrained()->onDelete('cascade');
            $table->string('sph_od')->nullable();
            $table->string('cyl_od')->nullable();
            $table->string('axis_od')->nullable();
            $table->string('add_od')->nullable();
            $table->string('prism_od')->nullable();
            $table->string('sci_od')->nullable();

            $table->string('sph_os')->nullable();
            $table->string('cyl_os')->nullable();
            $table->string('axis_os')->nullable();
            $table->string('add_os')->nullable();
            $table->string('prism_os')->nullable();
            $table->string('sci_os')->nullable();

            $table->string('ipd')->nullable();
            $table->text('notes')->nullable();

            $table->string('lens_type')->nullable();
            $table->decimal('lens_purchase_price', 10, 2)->nullable();
            $table->decimal('lens_selling_price', 10, 2)->nullable();
            $table->foreignId('inventory_id')->nullable()->constrained('inventories')->onDelete('set null');

            $table->decimal('frame_price', 10, 2)->nullable();
            $table->decimal('other_costs', 10, 2)->nullable();
            $table->decimal('consultation_cost', 10, 2)->nullable();
            $table->decimal('total_cost', 10, 2)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('glasses_prescriptions');
    }
};
