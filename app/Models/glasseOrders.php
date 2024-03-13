<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class glasseOrders extends Model
{
    use HasFactory;
    private $table = 'glasse_orders';
    private $primaryKey = 'id';
    private $timestamps = true;

    // Relacion 1 a 1 con Cotizaciones de Glasse
    public function glasseQuotes()
    {
        return $this->hasOne(glasseQuotes::class, 'folio_cotizacion_id');
    }

    // Relacion 1 a 1 con Ventas de Glasse
    public function glasseSales()
    {
        return $this->hasOne(glasseSales::class, 'folio_nota_venta_id')->optional();
    }

    // Relacion 1 a muchos con Comentarios de Ordenes de Glasse
    public function glasseOrderComments()
    {
        return $this->hasMany(glasseOrderComments::class, 'order_id');
    }
}
