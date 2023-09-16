@extends('AdminPage.Layouts.master')

@section('title')
    Page Product - Modul
@endsection

@section('content')
    <section class="content">
        <form action="{{ url('/ModulProduct/' . $modulProduct->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="productId" class="form-label">Product Id</label>
                <select name="productId" class="custom-select rounded-0" id="productId">
                    <option value="">Select a Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" @if ($product->id == $modulProduct->productId) selected @endif>
                            {{ $product->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" value="{{ $modulProduct->title }}" name="title" class="form-control"
                    id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="subTitle" class="form-label">Sub Title</label>
                <input type="text" value="{{ $modulProduct->subTitle }}" name="subTitle" class="form-control"
                    id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5">{{ $modulProduct->description }}"</textarea>
            </div>
            <div class="mb-3">
                <label for="icon" class="form-label">Image Title File</label>
                <input type="hidden" name="oldImage" value="{{ $modulProduct->icon }}">
                @if ($modulProduct->icon)
                    <img src="{{ asset('storage/' . $modulProduct->icon) }}" alt="image"
                        class="img-preview img-fluid mb-3 d-block">
                @else
                    <img class="img-preview img-fluid mb-3 mt-3">
                @endif
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="form-control" id="image1" name="icon"
                            onchange="previewImage(1)">
                        <label class="custom-file-label" for="image1">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="image_main" class="form-label">Image Show File</label>
                <input type="hidden" name="oldImage" value="{{ $modulProduct->image_main }}">
                @if ($modulProduct->image_main)
                    <img src="{{ asset('storage/' . $modulProduct->image_main) }}" alt="image"
                        class="img-preview img-fluid mb-3 d-block">
                @else
                    <img class="img-preview img-fluid mb-3 mt-3">
                @endif
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="form-control" id="image2" name="image_main"
                            onchange="previewImage(2)">
                        <label class="custom-file-label" for="image2">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/ModulProduct" type="button" class="btn btn-secondary">Back</a>
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
