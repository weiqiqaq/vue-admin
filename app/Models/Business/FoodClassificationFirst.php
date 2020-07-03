<?php


namespace App\Models\Business;


use Illuminate\Database\Eloquent\Model;

class FoodClassificationFirst extends Model
{
    protected $table = 'food_classification_first';
    protected $fillable = ['id','name'];
    public function second(){
        return $this->hasMany(FoodClassificationSecond::class,'pid','id')->with('third');
    }
}
