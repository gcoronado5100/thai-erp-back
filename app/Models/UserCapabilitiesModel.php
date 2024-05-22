<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCapabilitiesModel extends Model
{
    use HasFactory;
    protected $table = 'user_capabilities';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pdv()
    {
        return $this->belongsTo(PdvModel::class, 'pdv_id');
    }
}
