@extends('layout.admin.home')
@section('content_admin')
<div class="container">
    <h1>Tạo Banner Mới</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('banners.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" >
            @error('title')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="subtitle" class="form-label">Subtitle</label>
            <input type="text" class="form-control" id="subtitle" name="subtitle" >
            @error('subtitle')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description"></textarea>
            @error('description')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="fileImage" name="image" >
            <img id="img" src="{{ asset('/storage/' ) }}" width="111" class="mt-3">
            @error('image')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Create Banner</button>
    </form>
</div>

<script>
    var fileImage = document.querySelector("#fileImage");
    var img = document.querySelector("#img");
    
    fileImage.addEventListener('change', function(e) {
        if (this.files && this.files[0]) {
            img.src = URL.createObjectURL(this.files[0]);
            img.style.display = 'block'; 
        }
    });
</script>
@endsection
