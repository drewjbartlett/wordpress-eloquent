<?php

namespace WPEloquent\Model;

use \WPEloquent\Traits\HasMeta;

class Post extends  \Illuminate\Database\Eloquent\Model {

    use HasMeta;

    protected $table      = 'posts';
    protected $primaryKey = 'ID';
    public $timestamps    = false;

    const CREATED_AT = 'post_date';
	const UPDATED_AT = 'post_modified';

    public function author () {
        return $this->hasOne(\WPEloquent\Model\User::class, 'ID', 'post_author');
    }

    public function meta () {
        return $this->hasMany(\WPEloquent\Model\Post\Meta::class, 'post_id')
                    ->select(['post_id', 'meta_key', 'meta_value']);
    }

    public function terms () {
        return $this->hasManyThrough(
                    \WPEloquent\Model\Term\Taxonomy::class,
                    \WPEloquent\Model\Term\Relationships::class,
                    'object_id',
                    'term_taxonomy_id'
                )->with('term');
    }

    public function categories () {
        return $this->terms()->where('taxonomy', 'category');
    }

    public function attachments () {
        return $this->hasMany(\WPEloquent\Model\Attachment::class, 'post_parent', 'ID')->where('post_type', 'attachment');
    }

    public function tags () {
        return $this->terms()->where('taxonomy', 'post_tag');
    }

    public function comments () {
        return $this->hasMany(\WPEloquent\Model\Comment::class, 'comment_post_ID');
    }

    public function scopeStatus ($query, $status = 'publish') {
        return $query->where('post_status', $status);
    }

    public function scopeType ($query, $type = 'post') {
        return $query->where('post_type', $type);
    }

    public function scopePublished ($query) {
        return $query->status('publish');
    }

}
