<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlasseSalesModel extends Model
{
    use HasFactory;
    protected $table = 'glasse_sales';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function GlasseOrder()
    {
        return $this->belongsTo(GlasseOrderModel::class, 'order_id');
    }
}
