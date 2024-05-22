<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreddoSalesModel extends Model
{
    use HasFactory;
    protected $table = 'freddo_sales';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Relation 1 to 1 with Freddo Order
    public function freddoOrder()
    {
        return $this->belongsTo(FreddoOrderModel::class, 'folio_nota_venta_id');
    }
}
