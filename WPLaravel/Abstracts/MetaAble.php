<?php

namespace WPLaravel\Abstracts;

use WPLaravel\Core\Helpers;

abstract class MetaAble extends \Illuminate\Database\Eloquent\Model {

    public function getMeta($meta_key = false) {
        $meta_value = '';

        if($meta_key) {
            $meta_value = $this->meta()->where('meta_key', $meta_key)->pluck('meta_value')->first();

            if(Helpers::isSerialized($meta_value)) {
                $meta_value = unserialize($meta_value);
            }

        }

        return $meta_value;
    }

}
