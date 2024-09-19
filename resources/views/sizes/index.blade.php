
    <div class="container">
        <h1>Sizes List</h1>

   
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

      
        <a href="{{ route('sizes.create') }}" class="btn btn-primary mb-3">Create New Size</a>

       
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Size_Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($sizes as $size)
                    <tr>
                        <td>{{ $size->size_id }}</td>
                        <td>{{ $size->size_name }}</td>
                        <td>
                            <a href="{{ route('sizes.edit', $size->size_id) }}" class="btn btn-warning">Edit</a>
                          
                            <form action="{{ route('sizes.destroy', $size->size_id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa Size?');">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

