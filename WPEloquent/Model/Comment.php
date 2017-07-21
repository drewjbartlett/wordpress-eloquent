<?php

namespace WPEloquent\Model;

use \WPEloquent\Traits\HasMeta;

class Comment extends \Illuminate\Database\Eloquent\Model  {

    use HasMeta;

    protected $table      = 'comments';
    protected $primaryKey = 'comment_ID';
    protected $fillable   = [];
    public $timestamps    = false;

    const CREATED_AT = 'comment_date';

    public function post () {
        return $this->belongsTo(\WPEloquent\Model\Post::class);
    }

    public function meta () {
        return $this->hasMany(\WPEloquent\Model\Comment\Meta::class, 'comment_id')
                    ->select(['comment_id', 'meta_key', 'meta_value']);
    }

    public function user () {
        return $this->hasOne(\WPEloquent\Model\User::class, 'ID', 'user_id');
    }

}
