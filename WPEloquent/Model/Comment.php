<?php

namespace WPEloquent\Model;

class Comment extends \Illuminate\Database\Eloquent\Model  {

    use \WPEloquent\Traits\MetaTrait;

    protected $table      = 'comments';
    protected $primaryKey = 'comment_ID';
    public $timestamps    = false;

    public function post() {
        return $this->belongsTo('\WPEloquent\Model\Post');
    }

    public function meta() {
        return $this->hasMany('\WPEloquent\Model\Comment\Meta', 'comment_id')
                    ->select(['comment_id', 'meta_key', 'meta_value']);
    }

    public function user() {
        return $this->hasOne('\WPEloquent\Model\User', 'ID', 'user_id');
    }

}
