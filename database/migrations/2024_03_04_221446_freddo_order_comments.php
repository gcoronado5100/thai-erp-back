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
        Schema::create('freddo_order_comments', function (Blueprint $table) {
            $table->id();
            $table->integer('order_id');
            $table->integer('user_id');
            $table->string('comment');
            $table->string('type');
            $table->string('status');
            $table->string('attachment');
            $table->string('attachment_name');
            $table->string('attachment_type');
            $table->string('attachment_size');
            $table->string('attachment_path');
            $table->string('attachment_url');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('freddo_order_comments');
    }
};
