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
        Schema::create('check', function (Blueprint $table) {
            $table->id();
            $table->foreignUuid('endpoint_id')->index()->constrained('endpoints');
            $table->foreignUuid('site_id')->index()->constrained('sites');
            $table->integer('http_code')->nullable(true)->default(null);
            $table->longText('response')->nullable(true)->default(null);
            $table->timestamp('last_check')->nullable(true)->default(null);
            $table->timestamp('next_check')->nullable(true)->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('check');
    }
};
