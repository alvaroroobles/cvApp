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
        Schema::create('curriculum', function (Blueprint $table) {
            $table->id();
            $table->string('name',60);
            $table->string('surname',100);
            $table->string('surname2',120);
            $table->string('phone',11)->unique();
            $table->string('email',30);
            $table->string('born_date',30);
            $table->decimal('medium_mark', 2, 1);
            $table->text('experience');
            $table->text('formation');
            $table->text('skills');
            $table->string('image',100)->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curriculum');
    }
};
