<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SmallRuralDog\Admin\Auth\Database\Administrator;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::guard('admin')->user();
        $admin = Administrator::find($user->id);
        $admin->update($request);
        return response()->json(array(
            'code'=>200,
            'message'=>'更新成功'
        ),200);
    }
}
