<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Http\Controllers\Post\BaseController;

class DestroyController extends BaseController
{
   public function __invoke(Post $post) {
      $post->delete();
      return redirect()->route('post.index');
   }
}
