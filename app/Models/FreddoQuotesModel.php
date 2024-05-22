<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FreddoQuotesModel extends Model
{
    use HasFactory;
    protected $table = 'freddo_quotes';
    protected $primaryKey = 'id';

    public function FreddoOrder()
    {
        return $this->belongsTo(FreddoOrderModel::class, 'order_id');
    }
}
