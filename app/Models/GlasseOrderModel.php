<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlasseOrderModel extends Model
{
    use HasFactory;
    protected $table = 'glasse_orders';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function GlasseQuotes()
    {
        return $this->hasOne(GlasseQuotesModel::class, 'order_id');
    }

    public function GlasseSales()
    {
        return $this->hasOne(GlasseSalesModel::class, 'order_id');
    }

    public function GlasseOrderComments()
    {
        return $this->hasMany(GlasseOrderCommentsModel::class, 'order_id');
    }

    public function GlasseOrderStatus()
    {
        return $this->belongsTo(OrderStatusModel::class, 'order_id');
    }

    public function GlasseClients()
    {
        return $this->belongsTo(GlasseClients::class, 'client_id');
    }
}
