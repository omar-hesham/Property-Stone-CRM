<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('amenities_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('amenities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('amenities_group_amenity', function (Blueprint $table) {
            $table->foreignId('amenities_group_id')->constrained('amenities_groups')->cascadeOnDelete();
            $table->foreignId('amenity_id')->constrained('amenities')->cascadeOnDelete();
            $table->primary(['amenities_group_id','amenity_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('amenities_group_amenity');
        Schema::dropIfExists('amenities');
        Schema::dropIfExists('amenities_groups');
    }
};
