<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name', 'parent_id'];
    public $timestamps = false;
    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = str_slug($value);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
    public function parent(){
        return $this->belongsTo(Category::class, 'parent_id');
    }
}
