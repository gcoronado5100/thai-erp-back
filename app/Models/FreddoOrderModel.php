<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreddoOrderModel extends Model
{
    use HasFactory;
    protected $table = 'freddo_order';
    protected $primaryKey = 'id';

    public function FreddoQuotes()
    {
        return $this->hasOne(FreddoQuotesModel::class, 'order_id');
    }

    public function FreddoSales()
    {
        return $this->hasOne(FreddoSalesModel::class, 'order_id');
    }

    public function FreddoOrderComments()
    {
        return $this->hasMany(FreddoOrderCommentsModel::class, 'order_id');
    }

    public function FreddoOrderStatus()
    {
        return $this->belongsTo(OrderStatusModel::class, 'order_id');
    }

    public function FreddoClients()
    {
        return $this->belongsTo(FreddoClients::class, 'client_id');
    }
}
