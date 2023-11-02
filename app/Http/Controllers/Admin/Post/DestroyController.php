<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post;
use App\Http\Controllers\Admin\Post\BaseController;

class DestroyController extends BaseController
{
   public function __invoke(Post $post) {
      $post->delete();
      return redirect()->route('admin.post.index');
   }
}
