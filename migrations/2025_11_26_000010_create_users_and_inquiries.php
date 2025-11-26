<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->enum('role', ['admin','agent','customer'])->default('customer');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('password');
            $table->foreignId('profile_media_id')->nullable()->constrained('media')->nullOnDelete();
            $table->string('company')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('inquiries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->nullable()->constrained('units')->nullOnDelete();
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('message')->nullable();
            $table->enum('source', ['website','phone','walk_in','ad'])->nullable();
            $table->enum('status', ['new','contacted','qualified','lost'])->default('new');
            $table->timestamps();
            $table->softDeletes();

            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('inquiries');
        Schema::dropIfExists('users');
    }
};
