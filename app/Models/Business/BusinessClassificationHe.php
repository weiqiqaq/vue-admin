<?php


namespace App\Models\Business;


use Illuminate\Database\Eloquent\Model;

class BusinessClassificationHe extends Model
{
    protected $table = 'business_classification_he';
    protected $fillable = ['id','business_id','classification_id'];
    public function business(){
        return $this->hasMany(Business::class,'id','business_id')->select('id','user_name','shop_image');
    }
    public function class(){
        return $this->hasMany(BusinessClassificationThird::class,'id','classification_id');
    }
}
