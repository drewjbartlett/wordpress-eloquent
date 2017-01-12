<?php

namespace WPLaravel\Model;

class Post extends  \Illuminate\Database\Eloquent\Model {

    use \WPLaravel\Traits\MetaTrait;

    protected $table      = 'posts';
    protected $primaryKey = 'ID';
    public $timestamps    = false;

    public function author() {
        return $this->hasOne('\WPLaravel\Model\User', 'ID', 'post_author');
    }

    public function meta() {
        return $this->hasMany('\WPLaravel\Model\Post\Meta', 'post_id')
                    ->select(['post_id', 'meta_key', 'meta_value']);
    }

    public function terms() {
        return $this->hasManyThrough('\WPLaravel\Model\Term\Taxonomy', '\WPLaravel\Model\Term\Relationships', 'object_id', 'term_taxonomy_id')
                    ->with('term');
    }

    public function categories() {
        return $this->terms()->where('taxonomy', 'category');
    }

    public function tags() {
        return $this->terms()->where('taxonomy', 'post_tag');
    }

    public function comments() {
        return $this->hasMany('\WPLaravel\Model\Comment', 'comment_post_ID');
    }

    public function scopePublished($query) {
        return $query->where('post_status', 'publish');
    }

}
