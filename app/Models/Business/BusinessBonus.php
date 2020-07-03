<?php


namespace App\Models\Business;


use Illuminate\Database\Eloquent\Model;

class BusinessBonus extends Model
{
    protected $table = 'business_bonus';
    protected $fillable = ['id','type_id','business_id','tee'];
    public function type(){
        return $this->belongsTo(BonusType::class,'type_id','id');
    }
    public function business(){
        return $this->belongsTo(Business::class,'business_id','id')->select('id','user_title','shop_image')->with('shop_image');
    }

}
