<?php

namespace WPLaravel\Model\Comment;

class Meta extends \Illuminate\Database\Eloquent\Model {
    protected $table   = 'commentmeta';
    public $timestamps = false;

    public function comment() {
        return $this->belongsTo('\WPLaravel\Model\Comment');
    }
}
