<div class="mt-4">

    <div class="card">
        <div class="card-body">
            <form wire:submit="@if($updateForm) update @else save @endif">
                <div class="form-group mb-3">
                    <label for="categoryName">Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="categoryName" placeholder="Enter Name" wire:model="name">
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                    <label for="harga">Harga:</label>
                    <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" placeholder="Enter Harga" wire:model="harga">
                    @error('harga') <span class="text-danger">{{ $message }}</span> @enderror
                    <label for="harga">Kategori:</label>
                    <select class="form-select" wire:model="id_kategori">
                        @foreach (\App\Models\Kategori::all() as $kategori)
                            <option value="{{ $kategori->id_kategori }}">{{ $kategori->nama_kategori }}</option>
                        @endforeach
                    </select>
                    <label for="harga">Status:</label>
                    <select class="form-select" wire:model="id_status">
                        @foreach (\App\Models\Status::all() as $status)
                            <option value="{{ $status->id_status }}">{{ $status->nama_status }}</option>
                        @endforeach
                    </select>
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
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produk as $p)
                        <tr>
                            <td>{{ $p->nama_produk }}</td>
                            <td>Rp. {{ number_format($p->harga, 2, ",", ".") }}</td>
                            <td>{{ $p->kategori->nama_kategori }}</td>
                            <td>{{ $p->status->nama_status }}</td>
                            <td>
                                <button wire:click="edit({{ $p->id_produk }})" class="btn btn-primary btn-sm">Edit</button>
                                <button onclick="return confirm('Are you sure ?')" wire:click="destroy({{ $p->id_produk }})" class="btn btn-danger btn-sm">Delete</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $produk->links('livewire::bootstrap') }}
        </div>
    </div>
</div>
