<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ciampiOrders extends Model
{
    use HasFactory;
    private $table = 'ciampi_orders';
    private $primaryKey = 'id';
    public $timestamps = true;

    // Relacion 1 a 1 con Cotizaciones de Ciampi
    public function ciampiQuotes()
    {
        return $this->hasOne(ciampiQuotes::class, 'folio_cotizacion_id');
    }

    // Relacion 1 a 1 con Ventas de Ciampi
    public function ciampiSales()
    {
        return $this->hasOne(ciampiSales::class, 'folio_nota_venta_id')->optional();
    }

    // Relacion uno a muchos a la tabla ciampi_order_comments
    public function ciampiOrderComments()
    {
        return $this->hasMany(ciampiOrderComments::class, 'order_id');
    }
}
