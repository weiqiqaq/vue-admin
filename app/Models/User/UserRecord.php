<?php


namespace App\Models\Business;


use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class UserRecord extends Model
{
    protected $table = 'user_record';
    protected $fillable = ['id','business_id','user_id','fee','order_id','type'];
    public function business(){
        return $this->belongsTo(Business::class,'business_id','id')->select('id','bonus_status','user_title','shop_image','cost','status')->with('shop_image');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id')->select('id','name');
    }
}
