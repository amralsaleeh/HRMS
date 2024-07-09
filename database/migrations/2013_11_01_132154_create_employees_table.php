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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('contract_id')->constrained();
            $table->string('first_name');
            $table->string('father_name');
            $table->string('last_name');
            $table->string('mother_name');
            $table->string('birth_and_place');
            $table->string('national_number')->unique();
            $table->string('mobile_number')->unique();
            $table->string('degree');
            $table->boolean('gender');
            $table->string('address');
            $table->longText('notes')->nullable();
            $table
                ->integer('max_leave_allowed')
                ->length(2)
                ->default(0);
            $table->time('delay_counter')->default('00:00:00.00');
            $table->time('hourly_counter')->default('00:00:00.00');
            $table->boolean('is_active')->default(1);
            $table->string('profile_photo_path');
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
        Schema::dropIfExists('employees');
    }
};
