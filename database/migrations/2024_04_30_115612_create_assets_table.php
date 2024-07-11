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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();
            $table->string('old_id')->nullable();
            $table->string('serial_number')->nullable();
            $table->enum('class', ['Electronic', 'Furniture', 'Gear']);
            $table->enum('status', ['Good', 'Fine', 'Bad', 'Damaged']);
            $table->string('description')->nullable();
            $table->boolean('in_service')->default(1);
            $table->boolean('is_gpr')->default(1);
            $table->integer('real_price')->nullable();
            $table->integer('expected_price')->nullable();
            $table->date('acquisition_date')->nullable();
            $table->enum('acquisition_type', ['Directed', 'Founded', 'Transferred']);
            $table->string('funded_by')->nullable();
            $table->string('note')->nullable();
            $table->string('created_by');
            $table->string('updated_by');
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
