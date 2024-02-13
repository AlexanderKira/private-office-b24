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
        Schema::create('bitrix_reports', function (Blueprint $table) {
            $table->id();
            $table->string('channel_name');
            $table->integer('application');
            $table->decimal('conversion_to_sales', 5, 2);
            $table->integer('sales');
            $table->decimal('revenue', 15, 2);
            $table->decimal('average_check', 15, 2);
            $table->decimal('profit', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitrix_reports');
    }
};
