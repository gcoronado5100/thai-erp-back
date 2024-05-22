<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatusModel extends Model
{
    use HasFactory;
    protected $table = 'folio_status';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Relation 1 to Many with Ciampi Order
    public function ciampiOrders()
    {
        return $this->hasMany(CiampiOrderModel::class, 'order_id');
    }

    // Relation 1 to Many with Freddo Order
    public function freddoOrders()
    {
        return $this->hasMany(FreddoOrderModel::class, 'order_id');
    }

    // Relation 1 to Many with Glasse Order
    public function glasseOrders()
    {
        return $this->hasMany(GlasseOrderModel::class, 'order_id');
    }

    // Relation 1 to Many with Support Order
    public function supportOrders()
    {
        return $this->hasMany(SupportOrders::class, 'order_id');
    }
}
