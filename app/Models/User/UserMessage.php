<?php

namespace App\Models\User;

use App\Models\Api\Files;
use App\Models\Order\Order;
use Illuminate\Database\Eloquent\Model;

class UserMessage extends Model
{
    protected $table = 'user_message';
    protected $fillable = ['user_id','message','message_code','is_confirm','num'];
//
    function session()
    {
        return $this->hasMany(UserSocket::class,'user_id','user_id')->where('status','=',1);
    }

    function order()
    {
        return $this->belongsTo(Order::class,'num')->with('business')->select('id','business_id');
    }
}
