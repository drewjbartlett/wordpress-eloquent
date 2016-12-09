<?php

namespace WPLaravel\Model;

use WPLaravel\Core\Helpers;

class Post extends \Illuminate\Database\Eloquent\Model {
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
