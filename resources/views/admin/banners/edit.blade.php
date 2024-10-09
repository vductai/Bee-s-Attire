
@extends('layout.admin.home')
@section('content_admin')
    <div class="container">
        <h1>Cập Nhật Banner</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('banners.update',$banner) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $banner->id }}">

            <div class="form-group">
                <label for="title">title</label>
                <input type="text" name="title" class="form-control" value="{{ $banner->title }}" required>
            </div>

            <div class="form-group">
                <label for="subtitle">subtitle</label>
                <input type="text" name="subtitle" class="form-control" value="{{ $banner->subtitle }}" required>
            </div>

            <div class="form-group">
                <label for="description">description</label>
                <textarea name="description" class="form-control" required>{{ $banner->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="image">image</label>
                <input type="file" name="image" id="fileImage" class="form-control" >
                <img id="img" src="{{ asset('storage/' . $banner->image) }}" alt="" style="width: 200px; height: auto;">
            </div>

            <button type="submit" class="btn btn-primary">Update Banner</button>
        </form>
    </div>
    <script>
        var fileImage = document.querySelector("#fileImage");
        var img = document.querySelector("#img");
        
        fileImage.addEventListener('change', function(e) {
            if (this.files && this.files[0]) {
                img.src = URL.createObjectURL(this.files[0]);
                img.style.display = 'block'; // Hiển thị ảnh
            }
        });
    </script>
@endsection
