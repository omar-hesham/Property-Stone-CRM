<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('payment_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();
            $table->string('plan_name')->nullable();
            $table->decimal('down_payment_percentage', 5, 2)->nullable();
            $table->decimal('down_payment_amount', 14, 2)->nullable();
            $table->integer('installments_count')->nullable();
            $table->enum('installment_frequency', ['monthly','quarterly','yearly'])->nullable();
            $table->decimal('installment_value', 14, 2)->nullable();
            $table->decimal('maintenance_fee', 14, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index('unit_id');
        });

        Schema::create('floor_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();
            $table->foreignId('media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->integer('width_px')->nullable();
            $table->integer('height_px')->nullable();
            $table->string('scale')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('floor_plans');
        Schema::dropIfExists('payment_plans');
    }
};
