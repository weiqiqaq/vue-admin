<?php

namespace App\Models\User;

use App\Models\Api\Files;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'user';
    protected $fillable = ['name','password','fee','carte_card','medical_card','phone','card','hospital_id','is_register','register_id','Collection','family_name','family_phone','family_wechat','image','hospitalization_date','unhospitalization_date'];
    public function address(){
        return $this->hasMany(Address::class,'user_id','id');
    }
    public function collection(){
        return $this->hasMany(Collection::class,'user_id','id')->with('business');
    }
    public function bonus()
    {
        return $this->hasMany(BonusRecord::class,'user_id');
    }

}
