<?php

namespace WPEloquent\Model;

class Post extends  \Illuminate\Database\Eloquent\Model {

    use \WPEloquent\Traits\MetaTrait;

    protected $table      = 'posts';
    protected $primaryKey = 'ID';
    public $timestamps    = false;

    const CREATED_AT = 'post_date';
	const UPDATED_AT = 'post_modified';

    public function author() {
        return $this->hasOne('\WPEloquent\Model\User', 'ID', 'post_author');
    }

    public function meta() {
        return $this->hasMany('\WPEloquent\Model\Post\Meta', 'post_id')
                    ->select(['post_id', 'meta_key', 'meta_value']);
    }

    public function terms() {
        return $this->hasManyThrough('\WPEloquent\Model\Term\Taxonomy', '\WPEloquent\Model\Term\Relationships', 'object_id', 'term_taxonomy_id')
                    ->with('term');
    }

    public function categories() {
        return $this->terms()->where('taxonomy', 'category');
    }

    public function tags() {
        return $this->terms()->where('taxonomy', 'post_tag');
    }

    public function comments() {
        return $this->hasMany('\WPEloquent\Model\Comment', 'comment_post_ID');
    }
	
   public function scopeStatus($query, $status = 'publish') {
        return $query->where('post_status', $status);
    }

    public function scopePublished($query) {
        return $query->where('post_status', 'publish');
    }
	
    public function scopeType($query, $type = 'post') {
        return $query->where('post_type', $type);
    }

}
