<?php
/**
 * Created by PhpStorm.
 * User: huy
 * Date: 13/12/2016
 * Time: 01:30
 */

namespace App\Repository\Tag;


use App\Model\Tag;

class TagEloquent implements TagRepo
{
    private $tag;

    public function __construct(Tag $tag)
    {
        $this->tag = $tag;
    }

    public function create($name)
    {
        return $this->tag->create($name);
    }

    public function search($name)
    {
        return $this->tag->where('name', 'like', "%$name%")->paginate(10);
    }

    public function getIndex()
    {
        return $this->tag->paginate(10);
    }


}