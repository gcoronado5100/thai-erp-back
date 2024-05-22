<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserTypeModel extends Model
{
    use HasFactory;
    protected $table = 'user_type';
    protected $primaryKey = 'id';
    public $timestamps = true;

    public function users()
    {
        return $this->belongsToMany(User::class, 'capabilities')->withPivot('pdv_id');
    }

    public function pdv()
    {
        return $this->belongsTo(PdvModel::class);
    }
}
