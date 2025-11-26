<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('buildings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->string('name')->nullable();
            $table->string('block_number')->nullable();
            $table->integer('floors_count')->nullable();
            $table->integer('year_built')->nullable();
            $table->foreignId('amenities_group_id')->nullable()->constrained('amenities_groups')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index('project_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('buildings');
    }
};
