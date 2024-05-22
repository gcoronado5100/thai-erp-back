<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CiampiSalesModel extends Model
{
    use HasFactory;
    protected $table = 'ciampi_sales';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Relation 1 to 1 with Ciampi Order
    public function ciampiOrder()
    {
        return $this->belongsTo(CiampiOrderModel::class, 'folio_nota_venta_id');
    }
}
