<?php

namespace WPLaravel\Model;

class Term extends \Illuminate\Database\Eloquent\Model  {

    use \WPLaravel\Traits\MetaTrait;
    
    protected $table = 'terms';
    protected $primaryKey = 'term_id';

    public function meta() {
        return $this->hasMany('\WPLaravel\Model\Term\Meta', 'term_id')
                    ->select(['term_id', 'meta_key', 'meta_value']);
    }

}
