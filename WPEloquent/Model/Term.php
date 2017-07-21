<?php

namespace WPEloquent\Model;

use \WPEloquent\Traits\HasMeta;

class Term extends \Illuminate\Database\Eloquent\Model  {

    use HasMeta;

    protected $table = 'terms';
    protected $primaryKey = 'term_id';

    public function meta() {
        return $this->hasMany(\WPEloquent\Model\Term\Meta::class, 'term_id')
                    ->select(['term_id', 'meta_key', 'meta_value']);
    }

}
