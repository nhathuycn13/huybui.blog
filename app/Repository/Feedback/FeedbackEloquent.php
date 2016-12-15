<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 15/12/2016
 * Time: 09:01
 */

namespace App\Repository\Feedback;


use App\Model\Feedback;

class FeedbackEloquent implements FeedbackRepo
{
    private $eloquent;

    public function __construct(Feedback $feedback) {$this->eloquent = $feedback; }

    public function create($attributes)
    {
        return $this->eloquent->create($attributes);
    }

    public function paginate($perPage = 10, $columns = ['*'])
    {
        return $this->eloquent->paginate($perPage, $columns);
    }

    public function update($id, $attributes)
    {
        $me = $this->eloquent->findOrFail($id);
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

            ->paginate(20);
    }

    public function findMe($id)
    {
        return $this->eloquent->findOrFail($id);
    }

}