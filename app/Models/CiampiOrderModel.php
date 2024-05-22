<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CiampiOrderModel extends Model
{
    use HasFactory;
    protected $table = 'ciampi_orders';
    protected $primaryKey = 'id';

    // Relation 1 to 1 with Ciampi Quotes
    public function ciampiQuotes()
    {
        return $this->hasOne(CiampiQuotes::class, 'folio_cotizacion_id');
    }

    // Relation 1 to 1 with Ciampi Sales
    public function ciampiSales()
    {
        return $this->hasOne(CiampiSales::class, 'folio_nota_venta_id')->optional();
    }

    // Relation one to many to the ciampi_order_comments table
    public function ciampiOrderComments()
    {
        return $this->hasMany(CiampiOrderComments::class, 'order_id');
    }

    // Relation 1 to 1 with Ciampi Order Status
    public function ciampiOrderStatus()
    {
        return $this->belongsTo(OrderStatusModel::class, 'order_id');
    }

    // Relation 1 to 1 with Ciampi Clients
    public function ciampiClients()
    {
        return $this->belongsTo(CiampiClients::class, 'id_cliente', 'id');
    }
}
