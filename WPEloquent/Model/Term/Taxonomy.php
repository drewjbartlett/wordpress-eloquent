<?php

namespace WPEloquent\Model\Term;

class Taxonomy extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'term_taxonomy';

    public function term() {
        return $this->belongsTo(\WPEloquent\Model\Term::class);
    }
}
