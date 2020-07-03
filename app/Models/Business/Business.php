<?php


namespace App\Models\Business;

use App\Models\Api\Files;
use App\Models\User\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Business extends Model
{
    protected $table = 'business';
    protected $fillable = ['id','fee','to_fee','class','businessarea','money','receiptNo','hisTransNum','hisOrderNum','name','because','user_title','area','user_status','area','user_name','password','phone','business_phone','address','bonus_status','cost','consumption','body','status','shop_image','display_show','Business_license'];
    public function food(){
        return $this->hasMany(Food::class,'business_id','id')->with(['image','category']);
    }
    public function foods(){
        return $this->hasMany(Food::class,'business_id','id')->with('images');
    }
    public function time(){
        return $this->hasMany(BusinessTime::class,'business_id','id');
    }
    public function  collection(){
        return $this->hasMany(Collection::class,'business_id','id');
    }
    /**
     * @param $method
     */
    public function setClassAttribute($method)
    {
        if (is_array($method)) {
            $this->attributes['class'] = implode(',', $method);
        }
    }
    /**
     * @param $method
     *
     * @return array
     */
    public function getClassAttribute($method)
    {
        if (is_string($method)) {
            $r='';
            $rw=explode(",",$method);
            foreach ($rw as $k=>$v)
            {
                $r=$r.','.BusinessClassificationThird::find($v)->name;
            }
            $r=substr($r,1);
            $r=explode(',', $r);
            return array_filter($r);
        }
        return $method;
    }
    /**
     * @param $method
     */
    public function setBusinessLicenseAttribute($method)
    {
        if (is_array($method)) {
            $this->attributes['Business_license'] = implode(',', $method);
        }
    }
    /**
     * @param $method
     *
     * @return array
     */
    public function getBusinessLicenseAttribute($method)
    {
        if (is_string($method)) {
            return array_filter(explode(',', $method));
        }
        return $method;
    }
}
