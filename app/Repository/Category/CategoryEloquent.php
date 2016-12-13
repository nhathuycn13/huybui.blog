<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 09/12/2016
 * Time: 10:06
 */

namespace App\Repository\Category;


use App\Model\Category;

class CategoryEloquent implements CategoryRepo
{
    private $eloquent;

    public function __construct(Category $category) {$this->eloquent = $category; }

    public function create($attributes)
    {
        return $this->eloquent->create($attributes);
    }

    public function paginate($perPage = 10, $columns = ['*'])
    {
        return $this->eloquent->with('parent')->paginate($perPage, $columns);
    }

    public function update($id, $attributes)
    {
        $me = $this->eloquent->with('parent')->findOrFail($id);
        return $me->update($attributes) ? $me->load('parent') : response('Error!');
    }
    public function delete($id)
    {
        return $this->eloquent->destroy($id);
    }

    public function searchMe($keyword)
    {
        $id = intval($keyword);
        return $this->eloquent->where('name', 'like', "%$keyword%")
                                ->orWhere('id', '=', $id)
                                ->orWhere('parent_id', '=', $id)
                                ->with('parent')
                                ->paginate(20);
    }

    public function findMe($id)
    {
        return $this->eloquent->with('parent')->findOrFail($id);
    }

}