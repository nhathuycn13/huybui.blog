<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 15/12/2016
 * Time: 09:01
 */

namespace App\Repository\Feedback;


interface FeedbackRepo
{
    public function create($attributes);
    public function paginate($perPage = 10, $columns = array('*'));
    public function update($id, $attributes);
    public function delete($id);
    public function findMe($id);
    public function searchMe($keyword);
}