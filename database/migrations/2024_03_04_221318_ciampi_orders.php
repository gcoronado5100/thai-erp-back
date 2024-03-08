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
        Schema::create('ciampi_orders', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('created_by'); // Clave foranea del vendedor
            $table->unsignedBigInteger('edited_by')->nullable(); // Clave foranea del usuario
            $table->unsignedBigInteger('pdv'); // Clave foranea del pdv
            $table->unsignedBigInteger('id_cliente'); // Clave foranea del cliente
            $table->json('productos'); //JSON Generado en la app de cliente
            $table->json('descuentos')->nullable(); //JSON Generado en la app de cliente
            $table->unsignedBigInteger('folio_status_id'); // tipo de Folio => cotizacion, nota de venta o cancelada
            $table->unsignedBigInteger('folio_cotizacion_id')->nullable(); // Generado antes de proceder a guardar la orden
            $table->unsignedBigInteger('folio_nota_venta_id')->nullable();
            $table->unsignedBigInteger('delivery_status_id')->nullable();  // Estado de almacen (por despachar o entregado)
            $table->boolean('pdv_approval')->default(false); // Aprobacion del gerente de PDV
            $table->boolean('assitant_approval')->default(false); // Aprobado por assitencia de direccion
            $table->boolean('manager_approval')->default(false); // Aprobado por subdirector
            $table->boolean('ceo_approval')->default(false); // Aprobado por director general
            $table->float('subtotal_productos');
            $table->float('subtotal_promos')->nullable();
            $table->json('detalle_anticipo')->nullable();
            $table->json('detalles_pago');
            $table->string('observaciones')->nullable();
            $table->float('total');

            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('edited_by')->references('id')->on('users');
            $table->foreign('pdv')->references('id')->on('pdvs');
            $table->foreign('id_cliente')->references('id')->on('clients');
            $table->foreign('folio_cotizacion_id')->references('id')->on('ciampi_quotes');
            $table->foreign('folio_nota_venta_id')->references('id')->on('ciampi_sales');
            $table->foreign('folio_status_id')->references('id')->on('folio_status');
            $table->foreign('delivery_status_id')->references('id')->on('delivery_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ciampi_orders');
    }
};
