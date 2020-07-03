<?php


namespace App\Models\Business;


use Illuminate\Database\Eloquent\Model;

class BonusType extends Model
{
    protected $table = 'bonus_type';
    protected $fillable = ['id','type_name','fee','no'];
}
