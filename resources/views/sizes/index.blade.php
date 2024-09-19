<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <title>Document</title>
</head>
<body>
    

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

</body>
</html>