@extends('layouts.admin')
@section('content')
<div class="">
   <form method="POST" action="{{ route('admin.post.update', $post->id) }}">
      @csrf
      @method('patch')
      <div class="form-group">
         <label for="title" class="form-label">Title</label>
         <input type="text" class="form-control" name="title" id="title" aria-describedby="title" value="{{ $post->title }}">
      </div>
      <div class="form-group">
         <label for="content" class="form-label">Content</label>
         <textarea class="form-control" name="content" id="content">{{ $post->content }}</textarea>
      </div>
      <div class="form-group">
         <label for="image" class="form-label">Image</label>
         <input type="text" class="form-control" name="image" id="image" aria-describedby="title" value="{{ $post->image }}">
      </div>
      <div class="form-group">
         <label for="category">Category</label>
         <select class="form-select" id="category" name="category_id">
            @foreach($categories as $category)
               <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>{{ $category->title }}</option>
            @endforeach
         </select>
      </div>
      <div class="form-group">
         <label for="tags">Tags</label>
         <select class="form-select" id="tags" name="tag_ids[]" multiple aria-label="Multiple select example">
            @foreach($tags as $tag) 
               <option value="{{ $tag->id }}" 
                  @foreach($post->tags as $ptag)
                     {{ $tag->id == $ptag->id ? 'selected' : '' }}
                  @endforeach
               >{{ $tag->title }}</option>
            @endforeach
         </select>
      </div>
      <button type="submit" class="btn btn-primary mt-3">Update</button>
   </form>
</div>
@endsection