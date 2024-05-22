<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportOrdersComments extends Model
{
    use HasFactory;
    protected $table = 'support_orders_comments';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function SupportOrders()
    {
        return $this->belongsTo(SupportOrders::class, 'order_id');
    }
}
