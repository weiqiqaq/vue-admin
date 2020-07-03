<?php

namespace App\Models\User;

use App\Models\Api\Files;
use Illuminate\Database\Eloquent\Model;

class UserSocket extends Model
{
    protected $table = 'user_socket_session';
    protected $fillable = ['client_id','user_id','status'];
}
