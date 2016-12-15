<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 14/12/2016
 * Time: 23:56
 */

namespace App\Repository\Config;


use Illuminate\Http\Request;

interface UserRepo
{
    public function getUser();
    public function updateUser(Request $request);
}