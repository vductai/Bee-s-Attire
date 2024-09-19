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
        <h1>Edit Size</h1>

        <!--  Validation Errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Form Edit  -->
        <form action="{{ route('sizes.update', $size->size_id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="size_name">Size Name</label>
                <input type="text" name="size_name" class="form-control" value="{{ $size->size_name }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update Size</button>
        </form>

        <!-- Trở lại trang chủ -->
        <a href="{{ route('sizes.index') }}" class="btn btn-secondary mt-3">Back to List</a>
    </div>

</body>
</html>