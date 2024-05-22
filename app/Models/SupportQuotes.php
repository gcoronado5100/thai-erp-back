<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupportQuotes extends Model
{
    use HasFactory;
    protected $table = 'support_quotes';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function SupportOrders()
    {
        return $this->belongsTo(SupportOrders::class, 'order_id');
    }
}
