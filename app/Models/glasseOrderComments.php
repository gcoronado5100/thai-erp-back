<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class glasseOrderComments extends Model
{
    use HasFactory;

    protected $table = 'glasse_order_comments';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function glasseOrders()
    {
        return $this->belongsTo(glasseOrders::class, 'order_id');
    }
}
