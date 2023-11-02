@extends('layouts.admin')
@section('content')
<div class="">
  <form method="POST" action="{{ route('admin.post.store') }}">
    @csrf
    <div class="form-group">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" name="title" id="title" aria-describedby="title" value="{{ old('title') }}">
      
      @error('title')
        <p style="color:red;">{{ $message }}</p>
      @enderror
    </div>
    <div class="form-group">
      <label for="content" class="form-label">Content</label>
      <textarea class="form-control" name="content" id="content">{{ old('content') }}</textarea>

      @error('content')
        <p style="color:red;">{{ $message }}</p>
      @enderror
    </div>
    <div class="form-group">
      <label for="image" class="form-label">Image</label>
      <input type="text" class="form-control" name="image" id="image" aria-describedby="title"  value="{{ old('image') }}">

      @error('image')
        <p style="color:red;">{{ $message }}</p>
      @enderror
    </div>
    <div class="form-group">
      <label for="category">Category</label>
      <select class="form-select" id="category" name="category_id">
        @foreach($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : ''}}>{{ $category->title }}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="tags">Tags</label>
      <select class="form-select" id="tags" name="tag_ids[]" multiple aria-label="Multiple select example">
        @foreach($tags as $tag) 
          <option value="{{ $tag->id }}">{{ $tag->title }}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary mt-3">Submit</button>
  </form>
</div>
@endsection