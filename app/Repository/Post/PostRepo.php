<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 09/12/2016
 * Time: 10:28
 */

namespace App\Repository\Post;


use Illuminate\Http\Request;

interface PostRepo
{
    public function create(Request $request);
    public function paginate($perPage = 10, $columns = array('*'));
    public function update($id, Request $request);
    public function delete($id);
    public function findMe($id);
    public function searchMe($keyword);
    public function getPost();
    public function findBySlug($slug);
}