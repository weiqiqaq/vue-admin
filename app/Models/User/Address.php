<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'address';
    protected $fillable = ['address','user_id','name','phone','status'];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id','id');
    }
}
