<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 09/12/2016
 * Time: 10:29
 */

namespace App\Repository\Post;


use App\Model\Post;
use App\Model\Tag;
use Illuminate\Http\Request;

class PostEloquent implements PostRepo

{
    private $eloquent;

    public function __construct(Post $post) {$this->eloquent = $post; }

    public function create(Request $request)
    {

        $currentUser = $request->user();

        $post = $currentUser->posts()->create($request->toArray());

        foreach ($request->tags as $tag) {
            $post->tags()->attach(Tag::firstOrCreate($tag));
        }

        return $post;

    }

    public function paginate($perPage = 10, $columns = ['*'])
    {
        return $this->eloquent->with(['category', 'user', 'tags'])->paginate($perPage, $columns);
    }

    public function update($id, $attributes)
    {
        $me = $this->eloquent->findOrFail($id);
//        todoHuy: fix response below, hehe
        return $me->update($attributes) ? $me->load(['category', 'user', 'tags']) : response('Error!');
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
            ->orWhere('category_id', '=', $id)
            ->with(['category', 'user'])
            ->paginate(20);
    }

    public function findMe($id)
    {
        return $this->eloquent->with(['category', 'user', 'tags'])->findOrFail($id);
    }

}