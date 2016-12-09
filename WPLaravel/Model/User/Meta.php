<?php

namespace WPLaravel\Model\User;

class Meta extends \Illuminate\Database\Eloquent\Model {
    protected $table   = 'usermeta'; 
    public $timestamps = false;

    public function user() {
        return $this->belongsTo('\WPLaravel\Model\User');
    }
}
