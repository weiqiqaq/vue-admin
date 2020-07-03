<?php


namespace App\Models\Business;


use Illuminate\Database\Eloquent\Model;

class FoodClassificationHe extends Model
{
    protected $table = 'food_classification_he';
    protected $fillable = ['id','food_id','classification_id'];
    public function classification(){
        return $this->hasMany(FoodClassificationThird::class,'id','classification_id');
    }
    public function food(){
        return $this->hasMany(Food::class,'id','food_id');
    }
}
