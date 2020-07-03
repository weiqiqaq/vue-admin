<?php


namespace App\Models\User;


use App\Models\Business\Business;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    protected $table = 'collection';
    protected $fillable = ['business_id','user_id'];
    public function business(){
        return $this->hasMany(Business::class,'id','business_id')->select('id','bonus_status','user_title','body','shop_image','sales')->with('shop_image');
    }
}
