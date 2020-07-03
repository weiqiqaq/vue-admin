<?php


namespace App\Models\Business;


use Illuminate\Database\Eloquent\Model;

class FoodClassificationThird extends Model
{
    protected $table = 'food_classification_third';
    protected $fillable = ['id','name','pid','sort'];
    public function food(){
        return $this->hasMany(FoodClassificationHe::class,'classification_id','id')->with('food');
    }
    public function  parent(){
        return $this->hasOne(FoodClassificationSecond::class,'id','pid');
    }
}
