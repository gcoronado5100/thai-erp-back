<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CiampiOrderCommentsModel extends Model
{
    use HasFactory;
    private $table = 'ciampi_order_comments';
    private $primaryKey = 'id';
    public $timestamps = true;

    // Relation 1 to Many with Ciampi Order
    public function order()
    {
        return $this->belongsTo(CiampiOrderModel::class, 'order_id');
    }
}
