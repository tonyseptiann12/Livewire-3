<div class="mt-4">

    <div class="card">
        <div class="card-body">
            <form wire:submit="@if($updateForm) update @else save @endif">
                <div class="form-group mb-3">
                    <label for="categoryName">Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="categoryName" placeholder="Enter Name" wire:model="name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="d-grid gap-2">
                    @if ($updateForm)
                    <button type="submit" class="btn btn-info btn-block">Update</button>
                    @else
                    <button type="submit" class="btn btn-success btn-block">Save</button>                        
                    @endif
                </div>
            </form>
        </div>
    </div>

    <div class="card mt-4">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Slug</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>{{ $category->slug }}</td>
                            <td>
                                <button wire:click="edit({{ $category->id }})" class="btn btn-primary btn-sm">Edit</button>
                                <button onclick="return confirm('Are you sure ?')" wire:click="destroy({{ $category->id }})" class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $categories->links('livewire::bootstrap') }}
        </div>
    </div>
</div>
