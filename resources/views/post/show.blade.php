@extends('layouts.main')
@section('content')
<div class="">
  <div class="">{{ $post->id }}. {{ $post->title }}</div>
  <div class="">Content: {{ $post->content }}</div>
  <div class="">Category: {{ $post->category_id }}</div>
</div>
<div class="">
  <a href="{{ route('post.edit', $post->id )}}">Edit</a>
</div>
<div class="">
  <form action="{{ route('post.destroy', $post->id )}}" method="post">
    @csrf
    @method('delete')
    <input type="submit" class="btn btn-danger" value="Delete">
  </form>
</div>
<div class="">
  <a href="{{ route('post.index') }}">Back</a>
</div>
@endsection