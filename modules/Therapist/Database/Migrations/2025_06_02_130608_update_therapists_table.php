<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('therapists', function (Blueprint $table) {
            // Drop foreign key and column (if it exists)
            if (Schema::hasColumn('therapists', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            $table->string('name')->after('id');
            $table->string('phone')->after('name');
            $table->string('email')->after('phone');
        });
    }

    public function down()
    {
        Schema::table('therapists', function (Blueprint $table) {
            $table->dropColumn(['name', 'phone', 'email']);

            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }
};
