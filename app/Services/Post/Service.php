<?php 

namespace App\Services\Post;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class Service
{
   public function store($data) {

      try {
         DB::beginTransaction();
            
         $tags = $data['tags'];
         $category = $data['category'];
         unset($data['tags'], $data['category']);
      
      
         $tagIds = $this->getTagIds($tags);
         $data['category_id'] = $this->getCategoryId($category);
      
         $post = Post::create($data);
      
         $post->tags()->attach($tagIds);
         
         DB::commit();
      } catch (\Exception $e) {
         DB::rollback();
         return $e->getMessage();
      }
      
      return $post;
   }

   private function getTagIds($tags) {
      $tagIds = [];
      
      foreach ($tags as $tag) {
         $tag = !isset($tag['id']) ? Tag::create($tag) : Tag::find($tag['id']);
         $tagIds[] = $tag->id;
      }

      return $tagIds;
   }

   private function getTagIdsWithUpdate($tags) {
      $tagIds = [];
      
      foreach ($tags as $tag) {
         if (!isset($tag['id'])) {
            $tag = Tag::create($tag);
         }
         else {
            $currentTag = Tag::find($tag['id']);
            $currentTag->update($tag);
            $tag = $currentTag->fresh();
         }
         $tagIds[] = $tag->id;
      }
      return $tagIds;
   }

   private function getCategoryId($item) {
      $category = !isset($item['id']) ? Category::create($category) : Category::find($item['id']);
      return $category->id;
   }
   
   private function getCategoryIdWithUpdate($item) {
      if (!isset($item['id'])) {
         $category = Category::create($item);
      }
      else {
         $category = Category::find($item['id']);
         $category->update($item);
         $category = $category->fresh();
      }
      return $category->id;
   }
   
   public function update($post, $data) {
      
      try {
         DB::beginTransaction();

         $tags = $data['tags'];
         $category = $data['category'];
         unset($data['tags'], $data['category']);
         
         $tagIds = $this->getTagIdsWithUpdate($tags);
         $data['category_id'] = $this->getCategoryIdWithUpdate($category);

         $post->update($data);

         $post->tags()->sync($tagIds);

         DB::commit();
      } catch (\Exception $e) {
         DB::rollback();
         return $e->getMessage();
      }

      return $post->fresh();
   }
}