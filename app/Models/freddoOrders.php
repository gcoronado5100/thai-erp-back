<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class freddoOrders extends Model
{
    use HasFactory;

    protected $table = 'freddo_orders';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Relacion 1 a 1 con Cotizaciones de Freddo
    public function freddoQuotes()
    {
        return $this->hasOne(freddoQuotes::class, 'folio_cotizacion_id');
    }

    // Relacion 1 a 1 con Ventas de Freddo
    public function freddoSales()
    {
        return $this->hasOne(freddoSales::class, 'folio_nota_venta_id')->optional();
    }

    // Relacion 1 a muchos con Comentarios de Ordenes de Freddo
    public function freddoOrderComments()
    {
        return $this->hasMany(freddoOrderComments::class, 'order_id');
    }
}
