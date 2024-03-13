<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ciampiSales extends Model
{
    use HasFactory;
    private $table = 'ciampi_sales';
    private $primaryKey = 'id';
    public $timestamps = true;

    public function ciampiOrders()
    {
        return $this->belongsTo(ciampiOrders::class, 'folio_nota_venta_id');
    }
}
