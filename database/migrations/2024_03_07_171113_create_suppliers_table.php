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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->string('address_line_1', 150);
            $table->string('address_line_2', 150);
            $table->string('town', 150);
            $table->string('city', 200);
            $table->string('state', 200);
            $table->string('country', 200);
            $table->string('zip', 200);
            $table->string('phone', 200);
            $table->string('email', 200);
            $table->string('contact_name', 200);
            $table->string('contact_phone', 200);
            $table->string('contact_email', 200);
            $table->string('rfc', 200);
            $table->string('bank', 200);
            $table->string('account_number', 200);
            $table->string('clabe', 200);
            $table->string('swift', 200);
            $table->string('iban', 200);
            $table->string('currency', 200);
            $table->string('payment_terms', 200);
            $table->string('payment_method', 200);
            $table->string('payment_conditions', 200);
            $table->string('payment_days', 200);
            $table->string('payment_notes', 200);
            $table->string('notes', 200);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('edited_by')->references('id')->on('users');
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
