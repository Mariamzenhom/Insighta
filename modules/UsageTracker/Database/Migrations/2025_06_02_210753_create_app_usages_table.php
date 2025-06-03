<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up()
    {
        Schema::create('app_usages', function (Blueprint $table) {
          $table->id();
          $table->foreignId('user_id')->constrained()->onDelete('cascade');
          $table->enum('platform', ['facebook', 'twitter', 'instagram']);
          $table->integer('duration_minutes')->default(0);
          $table->date('date');
          $table->timestamps();
      });

    }
};
