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
        Schema::create('transitions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('asset_id')->constrained();
            $table->foreignId('employee_id')->constrained();
            $table->date('handed_date')->nullable();
            $table->date('return_date')->nullable();
            $table
                ->string('center_document_number')
                ->unique()
                ->nullable();
            $table->string('reason')->nullable();
            $table->longText('note')->nullable();
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
        Schema::dropIfExists('transitions');
    }
};
