@extends('AdminPage.Layouts.master')

@section('title')
    Page Product - List
@endsection

@section('content')
    <section class="content">
        <form action="{{ url('/ProductList/' . $productList->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="productId" class="form-label">Product Id</label>
                <select name="productId" class="custom-select rounded-0" id="productId">
                    <option value="">Select a Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" @if ($product->id == $productList->productId) selected @endif>
                            {{ $product->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="list" class="form-label">List</label>
                <input type="text" value="{{ $productList->list }}" name="list" class="form-control"
                    id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/ProductList" type="button" class="btn btn-secondary">Back</a>
            </div>
        </form>

        <style>
            .description {
                font-size: 14px;
                color: #888;
            }
        </style>

        <script>
            function previewImage() {
                const image = document.querySelector('#image');
                const imgPreview = document.querySelector('.img-preview');

                imgPreview.style.display = 'block';

                const oFReader = new FileReader();
                oFReader.readAsDataURL(image.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
            }
        </script>
    </section>
@endsection
