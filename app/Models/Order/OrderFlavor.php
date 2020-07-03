<?php


namespace App\Models\Order;


use Illuminate\Database\Eloquent\Model;

class OrderFlavor extends Model
{
    protected $table = 'order_flavor';
    protected $fillable = ['id','order_id','flavor_id'];
    public function flavor(){
        return $this->belongsTo(Flavor::class,'flavor_id');
    }
}