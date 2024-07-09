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
        Schema::create('droplet_object_elements', function (Blueprint $table) {
            $table->id();
            $table->integer('droplet_object_id');
            $table->string('name');
            $table->string('slug');
            $table->integer('length')->nullable();
            $table->tinyInteger('is_required')->default(true);
            $table->tinyInteger('nullable')->default(false);
            $table->string('collation')->default('utf8mb4');
            $table->string('default')->nullable()->default(null);
            $table->string('type');
            $table->integer('min')->nullable();
            $table->integer('max')->nullable();
            $table->string('relation_to')->nullable();
            $table->string('relation_via')->nullable();
            $table->string('foreign_key')->nullable();
            $table->string('reference_key')->nullable();
            $table->string('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('droplet_object_elements');
    }
};
