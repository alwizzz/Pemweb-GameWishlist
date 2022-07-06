@extends('layouts.main')

@section('content')

<h1>Add New Product</h1>

<a href="{{ route('product.index') }}" class="btn btn-primary my-2">Back</a>

<form action="{{ route('product.store') }}" method="post" enctype="multipart/form-data">
    @csrf
    <label for="title" class="form-label">Title</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" 
        name="title" value="{{ old('title') }}" autofocus>
    </div>
    @error('title')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror
    
    <label for="genre" class="form-label">Genre</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre" 
        name="genre" value="{{ old('genre') }}">
    </div>
    @error('genre')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror
    
    <label for="developer" class="form-label">Developer</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control @error('developer') is-invalid @enderror" id="developer" 
        name="developer" value="{{ old('developer') }}">
    </div>
    @error('developer')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror
    
    <label for="price" class="form-label">Price</label>
    <div class="input-group mb-3">
        <span class="input-group-text">Rp</span>
        <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" 
        name="price" value="{{ old('price') }}">
    </div>
    @error('price')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror

    <div class="mb-3">
        <label for="formFile" class="form-label">File Image </label>
        <img class="img-preview img-fluid mb-3 img-thumbnail" alt="" style="max-width: 500px; max-height:500px">
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
    </div>
    @error('image')
        <div class="text-danger">
            {{ $message }}  
        </div>
    @enderror

    <hr>
    <button name="submit" type="submit" class="btn btn-success mb-5">Add product</button>
</form>

{{-- <script src="../js/previewImage.js"></script> --}}

{{-- <script>
function previewImage()
{
    console.log('oy');
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(OFREvent){
        imgPreview.src = OFREvent.target.result;
    }
}
</script> --}}





@endsection