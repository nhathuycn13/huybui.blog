<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 14/12/2016
 * Time: 23:56
 */

namespace App\Repository\Config;


use App\User;
use Illuminate\Http\Request;
use Auth;

class UserEloquent implements UserRepo
{
    public function getUser()
    {
        return Auth::user();
    }

    public function updateUser(Request $request)
    {
        return Auth::user()->update($request->toArray()) ? response('updated') : response('err', 451);
    }

}