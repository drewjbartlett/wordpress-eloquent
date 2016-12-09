<?php

namespace WPLaravel\Model;

use WPLaravel\Core\Helpers;

class User extends \Illuminate\Database\Eloquent\Model {

    protected $table      = 'users';
    protected $primaryKey = 'ID';
    public $timestamps    = false;

    /**
     * [posts description]
     * @return [type] [description]
     * @author drewjbartlett
     */
    public function posts() {
        return $this->hasMany('\WPLaravel\Model\Post', 'post_author')
                    ->where('post_status', 'publish')
                    ->where('post_type', 'post');
    }

    /**
     * [meta description]
     * @return [type] [description]
     * @author drewjbartlett
     */
    public function meta() {
        return $this->hasMany('\WPLaravel\Model\User\Meta', 'user_id')
                    ->select(['user_id', 'meta_key', 'meta_value']);
    }

    /**
     * [getMeta description]
     * @param  boolean $meta_key [description]
     * @return [type]            [description]
     * @author drewjbartlett
     */
    public function getMeta($meta_key = false) {
        $meta_value = '';

        if($meta_key) {
            $meta_value = $this->meta()->where('meta_key', $meta_key)->pluck('meta_value')->first();

            if(Helpers::isSerialized($meta_value)) {
                $meta_value = unserialize($meta_value);
            }

        }

        return $meta_value;
    }
}
