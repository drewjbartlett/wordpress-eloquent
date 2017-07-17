<?php

namespace WPEloquent\Model;

class Term extends \Illuminate\Database\Eloquent\Model  {

    use \WPEloquent\Traits\HasMeta;
    
    protected $table = 'terms';
    protected $primaryKey = 'term_id';

    public function meta() {
        return $this->hasMany('\WPEloquent\Model\Term\Meta', 'term_id')
                    ->select(['term_id', 'meta_key', 'meta_value']);
    }

}
