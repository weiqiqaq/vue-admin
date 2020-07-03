<?php


namespace App\Models\Order;
use App\Models\Business\Food;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'cart';
    protected $fillable = ['num','good_id','user_id'];

    public function food()
    {
        return $this->belongsTo(Food::class,'good_id')->with(['business','image']);
    }
}

