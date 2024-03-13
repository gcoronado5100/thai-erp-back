<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ciampiQuotes extends Model
{
    use HasFactory;
    private $table = 'ciampi_quotes';
    private $primaryKey = 'id';
    public $timestamps = true;

    public function ciampiOrders()
    {
        return $this->belongsTo(ciampiOrders::class, 'folio_cotizacion_id');
    }
}
