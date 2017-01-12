<?php

namespace WPEloquent\Model;

class Comment extends \Illuminate\Database\Eloquent\Model  {

    use \WPEloquent\Traits\MetaTrait;

    protected $table      = 'comments';
    protected $primaryKey = 'comment_ID';
    protected $fillable = [];
    public $timestamps    = false;

    const CREATED_AT = 'comment_date';

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
