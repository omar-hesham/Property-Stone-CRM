<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique()->nullable();
            $table->string('short_description')->nullable();
            $table->text('full_description')->nullable();
            $table->foreignId('developer_id')->nullable()->constrained('developers')->nullOnDelete();
            $table->foreignId('location_id')->nullable()->constrained('locations')->nullOnDelete();
            $table->date('start_date')->nullable();
            $table->date('delivery_date')->nullable();
            $table->enum('status', ['draft','ongoing','ready','sold_out'])->default('draft');
            $table->foreignId('cover_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
            $table->index('developer_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
