<?php

namespace WPEloquent\Model\Comment;

class Meta extends \Illuminate\Database\Eloquent\Model {
    protected $table   = 'commentmeta';
    public $timestamps = false;

    public function comment() {
        return $this->belongsTo('\WPEloquent\Model\Comment');
    }
}
