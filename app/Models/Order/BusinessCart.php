<?php


namespace App\Models\Order;


use App\Models\Business\Business;
use App\Models\Business\Food;
use Illuminate\Database\Eloquent\Model;

class BusinessCart extends Model
{
    protected $table = 'business_cart';
    protected $fillable = ['num','good_id','business_id'];
    public function food()
    {
        return $this->belongsTo(Food::class,'good_id')->with('business');
    }
    public function business()
    {
        return $this->belongsTo(Business::class,'business_id')->select('id','user_name','shop_image');
    }
}
