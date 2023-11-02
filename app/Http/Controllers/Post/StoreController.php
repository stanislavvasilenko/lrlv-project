<?php

namespace App\Http\Controllers\Post;

use App\Models\Post;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Resources\Post\PostResource;
use App\Http\Controllers\Post\BaseController;

class StoreController extends BaseController
{
   public function __invoke(StoreRequest $request) {
      $data = $request->validated();

      $post = $this->service->store($data);

      return $post instanceof Post ? new PostResource($post) : $post;
      
      // return redirect()->route('post.index');
   }
}
