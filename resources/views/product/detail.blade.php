@extends('layouts.main')


@section('content')
    <div class="col">
        <div class="row">
            <div class="col-md-10 col-12">
                <h1>Product Detail</h1>

                <a href="{{ route('product.index') }}" class="btn btn-primary my-2">Back</a>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        @if(isset($product->image))
                        <img class="img-fluid img-thumbnail" src="{{ asset('storage/' . $product->image) }}"
                            style="max-height:500px; max-width:500px">
                        @else
                            <img class="img-fluid img-thumbnail" src="{{ asset('storage/' . 'images/_blank.jpg') }}"
                                style="max-height:500px; max-width:500px">
                            {{-- <td><img class="img-fluid" src="https://source.unsplash.com/1200x400" style="max-height:100px; max-width:100px"></td> --}}
                        @endif
                    </li>
                    <li class="list-group-item"><b>Title:</b> {{ $product->title }}</li>
                    <li class="list-group-item"><b>Genre:</b> {{ $product->genre }}</li>
                    <li class="list-group-item"><b>Developer:</b> {{ $product->developer }}</li>
                    <li class="list-group-item"><b>Price:</b> Rp{{ $product->price }}</li>
                </ul>
                <br>
                
            </div>
        </div>
    </div>
@endsection