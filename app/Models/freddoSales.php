<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class freddoSales extends Model
{
    use HasFactory;

    protected $table = 'freddo_sales';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Relacion 1 a 1 con Ordenes de Freddo
    public function freddoOrders()
    {
        return $this->belongsTo(freddoOrders::class, 'folio_nota_venta_id');
    }
}
