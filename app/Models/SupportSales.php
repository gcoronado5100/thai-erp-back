<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportSales extends Model
{
    use HasFactory;
    protected $table = 'support_sales';
    protected $primaryKey = 'id';

    public function SupportOrders()
    {
        return $this->belongsTo(SupportOrders::class, 'order_id');
    }
}
