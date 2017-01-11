<?php

namespace WPLaravel\Model;

class Comment extends \Illuminate\Database\Eloquent\Model  {

    use \WPLaravel\Traits\MetaTrait;

    protected $table      = 'comments';
    protected $primaryKey = 'comment_ID';
    public $timestamps    = false;

    public function post() {
        return $this->belongsTo('\WPLaravel\Model\Post');
    }

    public function meta() {
        return $this->hasMany('\WPLaravel\Model\Comment\Meta', 'comment_id')
                    ->select(['comment_id', 'meta_key', 'meta_value']);
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
