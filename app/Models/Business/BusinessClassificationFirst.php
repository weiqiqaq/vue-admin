<?php


namespace App\Models\Business;


use Illuminate\Database\Eloquent\Model;

class BusinessClassificationFirst extends Model
{
    protected $table = 'business_classification_first';
    protected $fillable = ['id','name'];
    public function second(){
        return $this->hasMany(BusinessClassificationSecond::class,'pid','id')->with('third');
    }
}
