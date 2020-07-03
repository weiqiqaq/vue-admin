<?php


namespace App\Models\Business;


use Illuminate\Database\Eloquent\Model;

class BusinessClassificationThird extends Model
{
    protected $table = 'business_classification';
    protected $fillable = ['id','name'];
    public function business(){
        return $this->hasMany(Business::class,'category_id','id')->with('business')->select('id','user_name','shop_image');
    }
}
