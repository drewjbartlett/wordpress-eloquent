<?php

namespace WPEloquent\Model\Term;

class Meta extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'term_meta';
    protected $fillable = ['meta_key', 'meta_value'];
    protected $primaryKey = 'meta_id';


}
