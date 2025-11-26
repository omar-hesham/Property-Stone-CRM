<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('units', function (Blueprint $table) {
            $table->id();
            $table->foreignId('building_id')->constrained('buildings')->cascadeOnDelete();
            $table->foreignId('project_id')->nullable()->constrained('projects')->nullOnDelete();
            $table->string('unit_code')->nullable();
            $table->string('unit_type')->nullable();
            $table->decimal('area_m2', 10, 2)->nullable();
            $table->integer('bedrooms')->nullable();
            $table->integer('bathrooms')->nullable();
            $table->string('finishing_type')->nullable();
            $table->integer('floor_number')->nullable();
            $table->decimal('price', 14, 2)->nullable();
            $table->string('currency', 10)->default('EGP');
            $table->enum('status', ['available','reserved','sold'])->default('available');
            $table->foreignId('floor_plan_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['project_id','price']);
            $table->index('unit_code');
        });
    }

    public function down()
    {
        Schema::dropIfExists('units');
    }
};
