<?php

namespace App;

use Carbon\Carbon;
use App\Common\Taggable;
use App\Common\Imageable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use SoftDeletes, Imageable, Taggable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'blogs';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at', 'published_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                    'platform_id',
                    'title',
                    'slug',
                    'excerpt',
                    'content',
                    'published_at',
                    'user_id',
                    'status'
                ];

    /**
     * Get the author associated with the blog post.
     */
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

	/**
     * Get the comments for the blog post.
     */
    public function comments()
    {
        return $this->hasMany(BlogComment::class);
    }

    /**
     * Scope a query to only include published blogs.
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->where('status', 1)->where('approved', 1)->whereNotNull('published_at');
    }

    /**
     * Set tag time formate for the post.
     *
     * @return array
     */
    public function setPublishedAtAttribute($value)
    {
        $this->attributes['published_at'] = $value ? date("Y-m-d H:i:s", strtotime($value)) : null;
        // $this->attributes['published_at'] = $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value) : null;
    }

    public function Platform()
    {
        return $this->belongsTo(Platform::class);
    }

}
