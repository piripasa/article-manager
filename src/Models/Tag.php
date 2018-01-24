<?php

namespace Piripasa\ArticleManager\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;

class Tag extends Model
{
	use Sluggable, SluggableScopeHelpers;

	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'tags';

    protected $fillable = [
    	'name', 'slug'
    ];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'slug_or_name',
            ],
        ];
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class, 'article_tag');
    }

    // The slug is created automatically from the "name" field if no slug exists.
    public function getSlugOrNameAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->name;
    }
}
