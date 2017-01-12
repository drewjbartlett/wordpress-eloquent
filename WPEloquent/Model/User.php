<?php

namespace WPEloquent\Model;

use WPEloquent\Core\Helpers;

class User extends \Illuminate\Database\Eloquent\Model  {

    use \WPEloquent\Traits\MetaTrait;

    protected $table      = 'users';
    protected $primaryKey = 'ID';
    public $timestamps    = false;

    public function posts() {
        return $this->hasMany('\WPEloquent\Model\Post', 'post_author')
                    ->where('post_status', 'publish')
                    ->where('post_type', 'post');
    }

    public function comments() {
        return $this->hasMany('\WPEloquent\Model\Comment', 'user_id');
    }


    public function meta() {
        return $this->hasMany('\WPEloquent\Model\User\Meta', 'user_id')
                    ->select(['user_id', 'meta_key', 'meta_value']);
    }

}
