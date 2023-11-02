<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\Admin\Post\BaseController;

class EditController extends BaseController
{
   public function __invoke(Post $post) {
      $categories = Category::all();
      $tags = Tag::all();
      $posts = Post::paginate(10);

      return view('admin.post.edit', compact('post', 'categories', 'tags', 'posts'));
   }
}
