<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('activity_updates', function (Blueprint $table) {
            $table->id();

            // Link to activity
            $table->foreignId('activity_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Who updated
            $table->string('updated_by_name');
            $table->string('updated_by_role');
            $table->string('updated_by_email');

            // What changed
            $table->string('old_status')->nullable();
            $table->string('new_status');

            $table->text('old_remark')->nullable();
            $table->text('new_remark')->nullable();

            // When update happened
            

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('activity_updates');
    }
};
