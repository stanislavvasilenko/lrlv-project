<?php

namespace App\Http\Controllers\Admin\Post;

use App\Models\Post;
use App\Http\Requests\Post\StoreRequest;
use App\Http\Controllers\Admin\Post\BaseController;

class StoreController extends BaseController
{
   public function __invoke(StoreRequest $request) {
      $data = $request->validated();

      $this->service->store($data);
      
      return redirect()->route('admin.post.index');
   }
}
