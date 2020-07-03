<?php


namespace App\Models\Order;


use Illuminate\Database\Eloquent\Model;

class Flavor extends Model
{
    protected $table = 'flavor';
    protected $fillable = ['id','flavor'];
}