<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\Post\BaseController;

class CreateController extends BaseController
{
   public function __invoke() {
      $categories = Category::all();
      $tags = Tag::all();
      $posts = Post::paginate(10);

      return view('admin.post.create', compact('categories', 'tags', 'posts'));
   }
}
