<?php

namespace WPLaravel\Model;

class Post extends  \Illuminate\Database\Eloquent\Model {

    use \WPLaravel\Traits\MetaTrait;

    protected $table      = 'posts';
    protected $primaryKey = 'ID';
    public $timestamps    = false;

    public function author() {
        return $this->hasOne('\App\Model\User', 'post_author');
    }

    public function meta() {
        return $this->hasMany('\WPLaravel\Model\Post\Meta', 'post_id')
                    ->select(['post_id', 'meta_key', 'meta_value']);
    }

    public function terms() {
        return $this->hasManyThrough('\WPLaravel\Model\Term\Taxonomy', '\WPLaravel\Model\Term\Relationships', 'object_id', 'term_taxonomy_id')
                    ->with('term');

        // return $this->hasManyThrough('\WPLaravel\Model\Term', '\WPLaravel\Model\Term\Relationships', 'object_id', 'term_id');
    }

    public function categories() {
        return $this->terms()->where('taxonomy', 'category');
    }

    public function tags() {
        return $this->terms()->where('taxonomy', 'tag');
    }

    // relationships

    public function comments() {
        return $this->hasMany('\WPLaravel\Model\Comment', 'comment_post_ID');
    }


}
