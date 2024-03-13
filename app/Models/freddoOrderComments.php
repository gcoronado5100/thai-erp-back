<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class freddoOrderComments extends Model
{
    use HasFactory;

    protected $table = 'freddo_order_comments';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function freddoOrders()
    {
        return $this->belongsTo(freddoOrders::class, 'folio_nota_venta_id');
    }
}
