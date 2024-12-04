<?php

namespace App\Jobs;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Tag;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateProductJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $product;
    protected $tagNames;
    protected $featuredCategories;
    protected $variants;

    /**
     * Create a new job instance.
     */
    public function __construct(Product $product, array $tagNames = [], array $featuredCategories = [], array $variants = [])
    {
        $this->product = $product;
        $this->tagNames = $tagNames;
        $this->featuredCategories = $featuredCategories;
        $this->variants = $variants;
    }


    public function handle()
    {
        // Handle tags
        if (!empty($this->tagNames)) {
            $tagArr = array_map('trim', $this->tagNames);
            $existingTags = Tag::whereIn('tag_name', $tagArr)->pluck('tag_id', 'tag_name')->toArray();
            $newTags = array_diff($tagArr, array_keys($existingTags));

            if (!empty($newTags)) {
                Tag::insert(array_map(fn($name) => ['tag_name' => $name], $newTags));
                $newTagsIds = Tag::whereIn('tag_name', $newTags)->pluck('tag_id', 'tag_name')->toArray();
                $existingTags = array_merge($existingTags, $newTagsIds);
            }
            $this->product->tags()->sync(array_values($existingTags));
        }

        // Handle featured categories
        if (!empty($this->featuredCategories)) {
            $this->product->featuredCategories()->sync($this->featuredCategories);
        }

        // Logic thêm biến thể
        if (!empty($this->variants)) {
            foreach ($this->variants as &$variant) {
                $variant['product_id'] = $this->product->product_id;
            }
            ProductVariant::insert($this->variants);
        }
    }
}
