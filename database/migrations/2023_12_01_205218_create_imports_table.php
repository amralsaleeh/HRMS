<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imports', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('file_size')->nullable();
            $table->string('file_ext')->nullable();
            $table->string('file_type')->nullable();
            $table->string('status')->nullable();
            $table->string('details')->nullable();
            $table->string('current')->default(0)->nullable();  // TODO: Change column name (make it clear)
            $table->string('total')->default(0)->nullable();    // TODO: Change column name (make it clear)
            $table->string('created_by');
            $table->string('updated_by');
            $table->string('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imports');
    }
}
