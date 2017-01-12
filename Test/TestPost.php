<?php
    namespace Test;

    class TestPost extends \WPEloquent\Model\Post {
        public function trails() {
            return $this->terms()->where('taxonomy', 'trail');
        }
    }
 ?>
