<?php


namespace App\Models\Order;
use App\Models\Business\Business;
use App\Models\Business\Food;
use App\Models\User\Bonus;
use App\Models\User\BonusRecord;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = ['user_id','type','hisOrderNum','hisTransNum','receiptNo','type','business_id','plat_orderid','no','total_fee','fee','bonus_fee','pay_status','trans_status','is_bale','plat_order',
        'status','accept','bonus_id','user_delete','business_delete','is_confirm','phone','cover','desc','name','address','is_revoke','active','finish_time','revoke_reason','because'];

    public function order_goods()
    {
        return $this->hasMany(OrderGoods::class,'order_id')->with('goods');
    }
    public function business()
    {
        return $this->belongsTo(Business::class,'business_id')->select('id','user_title','cost','shop_image')->with('shop_image');
    }
    public function bonus()
    {
        return $this->belongsTo(BonusRecord::class,'bonus_id');
    }
    public function user(){
        return $this->belongsTo(User::class,'user_id')->select('id','name');
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function flavor()
    {
        return $this->hasMany(OrderFlavor::class,'order_id')->with('flavor');
    }
}

