<?php


namespace App\Models\Order;


use Illuminate\Database\Eloquent\Model;

class OrderBecause extends Model
{
    protected $table = 'order_because';
    protected $fillable = ['id','name'];
}