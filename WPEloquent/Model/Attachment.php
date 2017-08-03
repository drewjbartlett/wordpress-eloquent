<?php

namespace WPEloquent\Model;

class Attachment extends Post {
	public function post () {
		return $this->belongsTo(Post::class, 'post_parent', 'ID');
	}
}
