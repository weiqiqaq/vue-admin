<?php


namespace App\Models\Business;


use Illuminate\Database\Eloquent\Model;

class FoodClassificationSecond extends Model
{
    protected $table = 'food_classification_second';
    protected $fillable = ['id','name','pid'];
    public function third(){
        return $this->hasMany(FoodClassificationThird::class,'pid','id');
    }
    public function parent(){
        return $this->hasOne(FoodClassificationFirst::class,'id','pid');
    }
}
