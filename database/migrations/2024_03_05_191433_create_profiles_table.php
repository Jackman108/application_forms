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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->date('birthdate');
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('country_code')->nullable();
            $table->string('marital_status')->nullable();
            $table->text('about')->nullable();
            $table->boolean('agreed_to_terms')->default(false);
            $table->timestamps();
        });

        // Таблица для хранения файлов
        Schema::create('profile_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
            $table->string('path');
            $table->timestamps();
        });

        // Таблица для хранения дополнительных телефонов
        Schema::create('additional_phones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->constrained('profiles')->onDelete('cascade');
            $table->string('phone', 255);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('additional_phones');
        Schema::dropIfExists('profile_files');
        Schema::dropIfExists('profiles');
    }
};
