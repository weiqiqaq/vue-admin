<?php


namespace App\Models\Business;


use Illuminate\Database\Eloquent\Model;

class UserTransfer extends Model
{
    protected $table = 'user_transfer';
    protected $fillable = ['id','business_id','fee'];
    public function business(){
        return $this->belongsTo(Business::class,'business_id','id')->select('id','bonus_status','user_title','shop_image','cost','status')->with('shop_image');
    }
}
