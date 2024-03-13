<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class glasseQuotes extends Model
{
    use HasFactory;

    protected $table = 'glasse_quotes';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function glasseOrders()
    {
        return $this->belongsTo(glasseOrders::class, 'folio_cotizacion_id');
    }
}
