<?php

namespace Piripasa\ArticleManager\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Intervention\Image\Image;

class Article extends Model
{
    use Sluggable, SluggableScopeHelpers;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'articles';

    protected $fillable = [
    	'slug', 'title', 'content', 'image', 'status', 'category_id', 'featured', 'date'
    ];
    
    protected $casts = [
        'featured'  => 'boolean',
        'date'      => 'date',
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
                'source' => 'slug_or_title',
            ],
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tag');
    }

    public function scopePublished($query)
    {
        return $query->where('status', 'PUBLISHED')
                    ->where('date', '<=', date('Y-m-d'))
                    ->orderBy('date', 'DESC');
    }

    // The slug is created automatically from the "title" field if no slug exists.
    public function getSlugOrTitleAttribute()
    {
        if ($this->slug != '') {
            return $this->slug;
        }

        return $this->title;
    }

    public function setImageAttribute($value) {
        $image = $value;
        $input['image'] = time().'.'.$image->getClientOriginalExtension();
        $img = Image::make($image->getRealPath());

        $destinationPath = public_path('/uploads/articles');
        $img->resize(750, 450, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['image']);

        $destinationPath = public_path('/uploads/articles/thumb');

        $img->resize(100, 100, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$input['image']);

        // $image->move($destinationPath, $input['image']); // for no resize

        $this->attributes['image'] =   strtolower($input['image']);
    }
}
