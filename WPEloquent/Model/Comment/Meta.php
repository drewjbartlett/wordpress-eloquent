<?php

namespace WPEloquent\Model\Comment;

class Meta extends \Illuminate\Database\Eloquent\Model {
    protected $table   = 'commentmeta';
    public $timestamps = false;
    protected $fillable = ['meta_key', 'meta_value'];
    protected $primaryKey = 'meta_id';


    public function comment() {
        return $this->belongsTo(\WPEloquent\Model\Comment::class);
    }
}
