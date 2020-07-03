<?php

namespace App\Models\User;

use App\Models\Api\Files;
use App\Models\Business\BonusType;
use Illuminate\Database\Eloquent\Model;

class BonusRecord extends Model
{
    //
    protected $table = 'bonus_record';
    protected $fillable = ['fee','no','user_id','type','is_used','use_time'];
    public function user()
    {
        return $this->belongsTo(User::class,'user_id')->select('id','name','phone');
    }
    public function type()
    {
        return $this->belongsTo(BonusType::class,'type')->select('id','no','type_name');
    }
}
