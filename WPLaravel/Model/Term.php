<?php

namespace WPLaravel\Model;

class Term extends \WPLaravel\Abstracts\MetaAble {
    protected $table = 'terms';
    protected $primaryKey = 'term_id';

    public function meta() {
        return $this->hasMany('\WPLaravel\Model\Term\Meta', 'post_id')
                    ->select(['post_id', 'meta_key', 'meta_value']);
    }

}
