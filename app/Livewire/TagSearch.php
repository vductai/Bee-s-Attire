<?php

namespace App\Livewire;

use App\Models\Tag;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class TagSearch extends Component
{
    public $searchTerm = '';


    public function render()
    {
        $tags = collect();

        Log::info($this->searchTerm);

        if (!empty($this->searchTerm)) {
            $tags = Tag::where('tag_name', 'like', '%' . $this->searchTerm . '%')->get();
        }
        return view('livewire.tag-search', ['tags' => $tags]);
    }
}
