<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class glasseSales extends Model
{
    use HasFactory;

    protected $table = 'glasse_sales';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function glasseOrders()
    {
        return $this->belongsTo(glasseOrders::class, 'folio_nota_venta_id');
    }
}
