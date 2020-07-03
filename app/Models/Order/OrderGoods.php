<?php


namespace App\Models\Order;
use App\Models\Business\Food;
use Illuminate\Database\Eloquent\Model;

class OrderGoods extends Model
{
    protected $table = 'order_goods';
    protected $fillable = ['order_id','good_id','fee','num'];

    public function goods()
    {
        return $this->belongsTo(Food::class,'good_id')->with('image');
    }
}

