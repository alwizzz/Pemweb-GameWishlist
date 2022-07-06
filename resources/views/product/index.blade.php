@extends('layouts.main')

@section('content')
    <h1>Game Wishlist</h1>
    @auth
        <a class="btn btn-primary md-3 mt-1" href="{{ route('product.create') }}">Add New Product</a>
    @endauth

    @if(session()->has('success'))
        <div class="alert alert-success mt-3" role="alert">{{ session('success') }}</div>
    @elseif(session()->has('fail'))
        <div class="alert alert-danger mt-3" role="alert">{{ session('fail') }}</div>
    @endif

    <table class="table table-stripped table-hover">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Genre</th>
                <th scope="col">Developer</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php $counter = 1; ?>
            @foreach($products as $product)
                <tr>
                    {{-- @dd(asset('storage') . '/' . $product->image); --}}
                    <th scope="row"><?= $counter; ?></th>
                    <td>
                        @if(isset($product->image))
                            <img class="img-fluid img-thumbnail" src="{{ asset('storage/' . $product->image) }}"
                                style="max-height:150px; max-width:150px">
                        @else
                            <img class="img-fluid img-thumbnail" src="{{ asset('storage/' . 'images/_blank.jpg') }}"
                                style="max-height:150px; max-width:150px">
                            {{-- <td><img class="img-fluid img-thumbnail" src="https://source.unsplash.com/1200x400" style="max-height:100px; max-width:100px"></td> --}}
                        @endif
                    </td>
                    <td>{{ $product->title }}</td>
                    <td>{{ $product->genre }}</td>
                    <td>{{ $product->developer }}</td>
                    <td>{{ 'Rp' . $product->price }}</td>
                    <td>
                        <div class="container d-flex">
                            <a class="btn btn-info mx-1" href="{{ route('product.show', $product->slug) }}">Detail</a>
                            @auth
                                <a class="btn btn-warning mx-1" href="{{ route('product.edit', $product->slug) }}">Edit</a>
                                <form action="{{ route('product.destroy', $product->slug) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    {{-- <input type="text" value="{{ $product->id }}" hidden name="id"> --}}
                                    <input type="submit" class="btn btn-danger mx-1" value="Remove" name="remove"
                                        onclick="return confirm('Are you sure you want to remove this product?')">
                                </form>
                            @endauth
                        </div>
                    </td>
                    <?php $counter++ ?>
                </tr>
            @endforeach
        </tbody>
    </table>

@endsection