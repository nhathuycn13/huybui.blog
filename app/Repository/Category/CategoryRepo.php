<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 09/12/2016
 * Time: 10:06
 */

namespace App\Repository\Category;


interface CategoryRepo
{
    public function create($attributes);
    public function paginate($perPage = 10, $columns = array('*'));
    public function update($id, $attributes);
    public function delete($id);
    public function findMe($id);
    public function searchMe($keyword);
}