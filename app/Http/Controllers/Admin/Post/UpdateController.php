<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post;
use App\Http\Requests\Post\UpdateRequest;
use App\Http\Controllers\Admin\Post\BaseController;

class UpdateController extends BaseController
{
   public function __invoke(UpdateRequest $request, Post $post) {
      $data = $request->validated();

      $this->service->update($post, $data);

      $posts = Post::paginate(10);

      return redirect()->route('admin.post.show', $post->id);
   }
}
