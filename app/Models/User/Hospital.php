<?php


namespace App\Models\User;


use Illuminate\Database\Eloquent\Model;

class Hospital extends Model
{
    protected $table = 'hospital';
    protected $fillable = ['name'];
}