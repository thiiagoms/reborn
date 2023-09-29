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
        Schema::create('endpoints', function (Blueprint $table) {
            $table->uuid('id')->index();
            $table->string('name');
            $table->integer('http');
            $table->integer('frequency');
            $table->integer('frequency_interval');
            $table->longText('payload')->nullable(true)->default(null);
            $table->foreignUuid('site_id')->index()->constrained('sites');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('endpoints');
    }
};
