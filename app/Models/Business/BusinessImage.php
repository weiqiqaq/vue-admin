<?php


namespace App\Models\Business;


use App\Models\Api\Files;
use Illuminate\Database\Eloquent\Model;

class BusinessImage extends Model
{
    protected $table = 'business_image';
    protected $fillable = ['id','business_id','image_id'];
    public function image(){
        return $this->belongsTo(Files::class,'image_id','id');
    }
}
