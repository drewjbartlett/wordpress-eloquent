<?php

namespace WPLaravel\Model\Term;

class Taxonomy extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'term_taxonomy';

    public function term() {
        return $this->belongsTo('\WPLaravel\Model\Term');
    }
}
