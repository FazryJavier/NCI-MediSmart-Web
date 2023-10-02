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
            @error('productId')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" value="{{ $modulProduct->title }}" name="title" class="form-control"
                    id="formGroupExampleInput">
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5">{{ $modulProduct->description }}"</textarea>
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="icon" class="form-label">Icon File</label>
                <span class="description">*Ukuran gambar 300x300px dan ukuran maksimal 5MB</span>
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
                        <input type="file" class="custom-file-input" id="image" name="icon"
                            onchange="previewImage()">
                        <label class="custom-file-label" for="label">Choose file <span class="description">(*.jpeg, .png,
                                .jpg, .gif, .webp)</label>
                    </div>
                </div>
            </div>
            @error('icon')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
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
