<form class="cr-search">
    <input class="search-input"
           id="search-box" autocomplete="off" wire:model.lazy="searchTerm"
           type="text" placeholder="Search For items...">
    <a href="javascript:void(0)" class="search-btn">
        <i class="ri-search-line"></i>
    </a>

    @if($tags->isNotEmpty())
        <div id="suggestion-box" class="suggestions">
            <ul>
                @foreach($tags as $tag)
                    <li class="text-decoration-none">{{ $tag->tag_name }}</li>
                @endforeach
            </ul>
        </div>
    @else
        <div id="suggestion-box" class="suggestions hidden">
            <p>Không tìm thấy tag phù hợp</p>
        </div>
    @endif
</form>
