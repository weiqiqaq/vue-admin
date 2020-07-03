<?php


namespace App\Models\Business;


use Illuminate\Database\Eloquent\Model;

class FoodCategory extends Model
{
    protected $table = 'food_category';
    protected $fillable = ['id','name'];
    public function foods(){
            return $this->hasMany(Food::class,'category_id','id')->with('image');
    }

}
