<?php


namespace App\Models\Business;


use App\Models\Api\Files;
use Illuminate\Database\Eloquent\Model;

class FoodImage extends  Model
{
    protected $table = 'food_image';
    protected $fillable = ['id','food_id','image_id'];
    public function image(){
        return $this->belongsTo(Files::class,'image_id','id');
    }

}
