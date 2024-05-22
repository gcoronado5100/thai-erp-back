<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSettingsModel extends Model
{
    use HasFactory;
    protected $table = 'user_settings';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['user_id', 'theme', 'pdv_id', 'showNews'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
