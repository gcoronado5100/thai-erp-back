<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportOrders extends Model
{
    use HasFactory;
    protected $table = 'support_orders';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function SupportQuotes()
    {
        return $this->hasOne(SupportQuotes::class, 'order_id');
    }

    public function SupportSales()
    {
        return $this->hasOne(SupportSales::class, 'order_id');
    }

    public function SupportOrderComments()
    {
        return $this->hasMany(SupportOrdersComments::class, 'order_id');
    }

    public function SupportOrderStatus()
    {
        return $this->belongsTo(OrderStatusModel::class, 'order_id');
    }
}
