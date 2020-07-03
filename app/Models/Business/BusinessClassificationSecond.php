<?php


namespace App\Models\Business;


use Illuminate\Database\Eloquent\Model;

class BusinessClassificationSecond extends Model
{
    protected $table = 'business_classification_second';
    protected $fillable = ['id','name','pid'];
    public function third(){
        return $this->hasMany(BusinessClassificationThird::class,'pid','id');
    }
    public function parent(){
        return $this->belongsTo(BusinessClassificationFirst::class,'pid','id');
    }
}
