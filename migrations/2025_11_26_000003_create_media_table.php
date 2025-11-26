<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('parent_type')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('media_type')->nullable();
            $table->string('file_path')->nullable();
            $table->string('url')->nullable();
            $table->string('mime_type')->nullable();
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->bigInteger('size_bytes')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->integer('order_index')->default(0);
            $table->timestamps();
            $table->softDeletes();

            $table->index(['parent_type','parent_id']);
            $table->index('media_type');
        });
    }

    public function down()
    {
        Schema::dropIfExists('media');
    }
};
