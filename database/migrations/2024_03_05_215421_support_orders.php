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
        Schema::create('support_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->unsignedBigInteger('pdv_id');
            $table->unsignedBigInteger('freddo_folio')->nullable();
            $table->unsignedBigInteger('glasse_folio')->nullable();
            $table->unsignedBigInteger('ciampi_folio')->nullable();
            $table->boolean('is_warranty')->default(false);
            $table->text('fail_description')->nullable();
            $table->text('diagnostic')->nullable();
            $table->json('services')->nullable();
            $table->json('parts')->nullable();
            $table->json('variables')->nullable();
            $table->json('discounts')->nullable();
            $table->json('reservation_details')->nullable();
            $table->json('payments_details');
            $table->float('subtotal');
            $table->float('discount_subtotal');
            $table->float('total');
            $table->json('shipping_details')->nullable();
            $table->text('observations')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('cotizacion_id');
            $table->unsignedBigInteger('nota_id');
            $table->timestamps();

            $table->foreign('client_id')->references('id')->on('clients');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
            $table->foreign('pdv_id')->references('id')->on('pdvs');
            $table->foreign('status_id')->references('id')->on('folio_status');
            $table->foreign('freddo_folio')->references('id')->on('freddo_folios');
            $table->foreign('glasse_folio')->references('id')->on('glasse_folios');
            $table->foreign('ciampi_folio')->references('id')->on('ciampi_folios');
            $table->foreign('cotizacion_id')->references('id')->on('support_quotes');
            $table->foreign('nota_id')->references('id')->on('support_notes');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('support_orders');
    }
};
