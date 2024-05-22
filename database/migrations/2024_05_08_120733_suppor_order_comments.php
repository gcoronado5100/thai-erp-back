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
        Schema::create('support_order_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            $table->unsignedBigInteger('user_id');
            $table->text('comment');
            $table->string('type');
            $table->string('status');
            $table->string('attachment');
            $table->string('attachment_name');
            $table->string('attachment_type');
            $table->string('attachment_size');
            $table->string('attachment_path');
            $table->string('attachment_url');
            $table->timestamps();

            $table->foreign('order_id')->references('id')->on('support_orders');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_order_comments');
    }
};
