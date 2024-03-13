<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ciampiOrderComments extends Model
{
    use HasFactory;

    protected $table = 'ciampi_order_comments';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function ciampiOrders()
    {
        return $this->belongsTo(ciampiOrders::class, 'folio_nota_venta_id');
    }
}
