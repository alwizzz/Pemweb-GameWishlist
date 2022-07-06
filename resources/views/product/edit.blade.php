@extends('layouts.main')

@section('content')

<h1>Edit Product</h1>

<a href="{{ route('product.index') }}" class="btn btn-primary my-2">Back</a>

<form action="{{ route('product.update', $product->slug) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    {{-- to store id --}}
    <input type="text" name="id" value="{{ $product->id }}" hidden> 

    {{-- to store original title for comparison if the submitted title is new or not
    <input type="text" name="original_title" value="{{ $product->title }}" hidden>  --}}

    <label for="title" class="form-label">Title</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" 
        name="title" value="{{ old('title', $product->title) }}" autofocus>
    </div>
    @error('title')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror
    
    <label for="genre" class="form-label">Genre</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre" 
        name="genre" value="{{ old('genre', $product->genre) }}">
    </div>
    @error('genre')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror
    
    <label for="developer" class="form-label">Developer</label>
    <div class="input-group mb-3">
        <input type="text" class="form-control @error('developer') is-invalid @enderror" id="developer" 
        name="developer" value="{{ old('developer', $product->developer) }}">
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
        name="price" value="{{ old('price', $product->price) }}">
    </div>
    @error('price')
        <div class="text-danger">
            {{ $message }}
        </div>
    @enderror

    <div class="mb-3">
        <label for="formFile" class="form-label">File Image</label>
        @if($product->image)
            <img src="{{ asset('storage/' . $product->image) }}" class="img-preview img-fluid mb-3 img-thumbnail d-block" alt="" style="max-width: 500px; max-height:500px">
        @else
            <img class="img-preview img-fluid mb-3 img-thumbnail" alt="" style="max-width: 500px; max-height:500px">
        @endif
        <input class="form-control @error('image') is-invalid @enderror" type="file" id="image" name="image" onchange="previewImage()">
    </div>
    @error('image')
        <div class="text-danger">
            {{ $message }}  
        </div>
    @enderror


    

    <hr>
    <button name="submit" type="submit" class="btn btn-success mb-5">Edit Product</button>
</form>


<script>
function previewImage()
{
    const image = document.querySelector('#image');
    const imgPreview = document.querySelector('.img-preview');

    imgPreview.style.display = 'block';

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function(OFREvent){
        imgPreview.src = OFREvent.target.result;
    }
}
</script>


@endsection