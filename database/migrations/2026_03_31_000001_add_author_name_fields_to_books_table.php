<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->string('last_name')->nullable()->after('author');
            $table->string('first_name')->nullable()->after('last_name');
            $table->string('middle_initial', 5)->nullable()->after('first_name');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['last_name', 'first_name', 'middle_initial']);
        });
    }
};
