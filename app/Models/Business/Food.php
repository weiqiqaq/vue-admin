<?php


namespace App\Models\Business;


use App\Models\Order\Cart;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    //ff
    protected $table = 'food';
    protected $fillable = ['id','name','price','body','food_id','food_item','market_price','food_num','sort','Recommend'
        ,'status','hot_sale','new_products','category_id','image','abbreviation','business_id'];
    public function classification(){
        return $this->hasMany(FoodClassificationHe::class,'food_id','id')->with('classification');
    }
    public function business(){
        return $this->belongsTo(Business::class,'business_id','id')->select('id','bonus_status','user_title','shop_image','cost','status')->with('shop_image');
    }
    public function category(){
        return $this->belongsTo(FoodCategory::class,'category_id','id');
    }
    public function image(){
        return $this->hasMany(FoodImage::class,'food_id','id')->with('image');
    }
    public function images(){
        return $this->hasone(FoodImage::class,'food_id','id')->with('image');
    }
    public function user()
    {
        return $this->belongsToMany(User::class,Cart::class,'good_id','user_id');
    }

}
