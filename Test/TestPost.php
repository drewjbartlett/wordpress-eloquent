<?php
    namespace Test;

    class TestPost extends \WPLaravel\Model\Post {
        public function trails() {
            return $this->terms()->where('taxonomy', 'trail');
        }
    }
 ?>
