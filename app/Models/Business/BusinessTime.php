<?php


namespace App\Models\Business;


use Illuminate\Database\Eloquent\Model;

class BusinessTime extends Model
{
    protected $table = 'business_time';
    protected $fillable = ['id','start_time','end_time','day','business_id'];
    public function business(){
        return $this->hasMany(Business::class,'id','business_id')->select('id','user_name');
    }
}
