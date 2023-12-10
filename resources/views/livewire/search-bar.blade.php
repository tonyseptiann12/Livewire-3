
<div>
    <form class="d-flex" role="search">
        <input wire:model.live='search' class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
    </form>
    <div class="dropdown-menu d-block py-0">
        @foreach ($data as $category)
            <div class="px-3 py-1 border-bottom">
                <div class="d-flex flex-column ml-3">
                    <span>{{ $category->name }}</span>
                </div>
            </div>
        @endforeach
    </div>
    
</div>
