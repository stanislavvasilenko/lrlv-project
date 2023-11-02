<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post;
use App\Http\Controllers\Admin\Post\BaseController;

class ShowController extends BaseController
{
   public function __invoke(Post $post) {
      $posts = Post::paginate(10);
      return view('admin.post.show', compact('post', 'posts'));
   }
}
