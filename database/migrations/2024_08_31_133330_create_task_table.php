<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('task', function (Blueprint $table) {
            $table->increments('task_id');
            $table->string('task_title',200);
            $table->text('task_description')->nullable();
            $table->string('task_file',100)->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('to_user_id');

            $table->tinyInteger('status')->default(1);
            $table->integer('creator');
            $table->integer('modifier');
            $table->dateTime('created_date');
            $table->dateTime('modified_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('task');
    }
};
