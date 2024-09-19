<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"> 
    <title>Create Size</title>
</head>
<body>
    

    <div class="container">
        <h1>Add New Size</h1>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form thêm mới -->
        <form action="{{ route('sizes.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="size_name">Size Name</label>
                <input type="text" name="size_name" class="form-control" required placeholder="Tên Size">
            </div>
            <button type="submit" class="btn btn-primary">Add Size</button>
        </form>

        <!-- Trở lại trang chủ -->
        <a href="{{ route('sizes.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>

</body>
</html>