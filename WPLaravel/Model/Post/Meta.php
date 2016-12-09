<?php

namespace WPLaravel\Model\Post;

class Meta extends \Illuminate\Database\Eloquent\Model {
    protected $table   = 'postmeta';
    public $timestamps = false;

    public function post() {
        return $this->belongsTo('\WPLaravel\Model\Post');
    }
}
