<?php

namespace App\Models\User;

use App\Models\Api\Files;
use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    //
    protected $table = 'bonus';
    protected $fillable = ['record_id','user_id','type'];

    public function record()
    {
        return $this->belongsTo(BonusRecord::class,'record_id');
    }
}
