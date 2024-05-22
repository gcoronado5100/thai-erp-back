<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GlasseClients extends Model
{
    use HasFactory;
    protected $table = 'clients_glasse';
    protected $primaryKey = 'id';
    // protected $fillable = [
    //     'registered_by', 'first_name', 'last_name', 'phone', 'email', 'address_street', 'address_ext', 'address_int', 'address_col', 'address_town', 'address_state', 'address_zip'
    // ];

    public function orders()
    {
        return $this->hasMany(GlasseOrders::class, 'client_id', 'id');
    }
}
