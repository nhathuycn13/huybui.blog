<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 13/12/2016
 * Time: 01:28
 */

namespace App\Repository\Tag;


interface TagRepo
{
    public function create($name);
    public function search($name);
    public function getIndex();
}