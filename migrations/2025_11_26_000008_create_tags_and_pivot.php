<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('unit_tag', function (Blueprint $table) {
            $table->foreignId('unit_id')->constrained('units')->cascadeOnDelete();
            $table->foreignId('tag_id')->constrained('tags')->cascadeOnDelete();
            $table->primary(['unit_id','tag_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('unit_tag');
        Schema::dropIfExists('tags');
    }
};
