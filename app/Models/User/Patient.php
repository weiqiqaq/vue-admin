<?php

namespace App\Models\User;

use App\Models\Api\Files;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    //
    protected $table = 'user';
    protected $fillable = ['name','phone','password','remember_token','register_code','login_code','is_register','register_code_time','login_code_time'];

    public function addresses()
    {
        return $this->hasMany(Address::class,'user_id');
    }

    public function avatar()
    {
        return $this->belongsTo(Files::class,'image');
    }

    public function bonus()
    {
        return $this->hasMany(Bonus::class,'user_id');
    }

    public function collection()
    {
        return $this->hasMany(Collection::class,'user_id');
    }
}
