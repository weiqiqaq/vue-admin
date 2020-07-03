<?php

namespace App\Models\User;

use App\Models\Api\Files;
use App\Models\Order\Order;
use Illuminate\Database\Eloquent\Model;

class BusinessMessage extends Model
{
    protected $table = 'business_message';
    protected $fillable = ['user_id','message','message_code','is_confirm','num'];

    function session()
    {
        return $this->hasMany(BusinessSocket::class,'user_id','user_id')->where('status','=',1);
    }


    function order()
    {
        return $this->belongsTo(Order::class,'num')->with(['order_goods','business']);
    }
}
