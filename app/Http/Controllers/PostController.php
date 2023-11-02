<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Category;

class PostController extends Controller
{
   public function index() {
      $posts = Post::all();
      return view('post.index', compact('posts'));
   }

   public function create() {
      $categories = Category::all();
      $tags = Tag::all();

      return view('post.create', compact('categories', 'tags'));
   }

   public function store() {
      $data = request()->validate([
         'title' => 'required|string',
         'content' => 'string',
         'image' => 'string',
         'category_id' => 'integer',
         'tag_ids' => '',
      ]);

      $tag_ids = $data['tag_ids'];
      unset($data['tag_ids']);

      $post = Post::create($data);

      $post->tags()->attach($tag_ids);
      // foreach($tag_ids as $id) {
      //    PostTag::firstOrCreate([
      //       'tag_id' => $id,
      //       'post_id' => $post->id,
      //    ]);
      // }
      
      return redirect()->route('post.index');
   }

   public function show(Post $post) {
      return view('post.show', compact('post'));
   }

   public function edit(Post $post) {
      $categories = Category::all();
      $tags = Tag::all();

      return view('post.edit', compact('post', 'categories', 'tags'));
   }

   public function update(Post $post) {
      // Post::where('is_published', 0)->update(['title' => 'not_published_title']);
      $data = request()->validate([
         'title' => 'string',
         'content' => 'string',
         'image' => 'string',
         'category_id' => 'integer',
         'tag_ids' => ''
      ]);

      $tag_ids = $data['tag_ids'];
      unset($data['tag_ids']);

      $post->update($data);
      // $post = $post->fresh();

      $post->tags()->sync($tag_ids);

      return redirect()->route('post.show', $post->id);
   }

   public function destroy(Post $post) {
      $post->delete();
      return redirect()->route('post.index');
   }

   public function delete() {
      $post = Post::withTrashed()->find(6)->restore();//find(6);
      // $post->delete();
   }

   public function firstOrCreate() {

      $anotherPost = [
         'title' => 'ano title of posts',
         'content' => 'ano some content',
         'image' => 'ano_img.jpg',
         'likes' => 20,
         'is_published' => 1,
      ];

      $myPost = Post::firstOrCreate(
         [
            'title' => 'o title of posts',
         ],
         [
            'title' => 'o title of posts',
            'content' => 'some o content',
            'image' => 'img.jpg',
            'likes' => 20,
            'is_published' => 1,
         ]   
      );

      dd($myPost->content);
   }

   public function updateOrCreate() {
      $anotherPost = [
         'title' => 'audpate or cteade ano title of posts',
         'content' => 'audpate or cteadeano some content',
         'image' => 'audpate or cteadeano_img.jpg',
         'likes' => 20,
         'is_published' => 1,
      ];

      $post = Post::updateOrCreate(
         [
            'title' => 'not ano title of posts'
         ],
         $anotherPost
      );
   }
}
