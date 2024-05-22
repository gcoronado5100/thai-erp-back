<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CiampiQuotesModel extends Model
{
    use HasFactory;
    protected $table = 'ciampi_quotes';
    protected $primaryKey = 'id';
    public $timestamps = true;

    // Relation 1 to 1 with Ciampi Order
    public function ciampiOrder()
    {
        return $this->belongsTo(CiampiOrderModel::class, 'folio_cotizacion_id');
    }
}
