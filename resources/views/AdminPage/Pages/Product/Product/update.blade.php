@extends('AdminPage.Layouts.master')

@section('title')
    Page Product - Product View
@endsection

@section('content')
    <section class="content">
        <form action="{{ url('/Product/' . $productUpdate->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" value="{{ $productUpdate->title }}" name="title" class="form-control"
                    id="formGroupExampleInput">
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="subTitle" class="form-label">Sub Title</label>
                <input type="text" value="{{ $productUpdate->subTitle }}" name="subTitle" class="form-control"
                    id="formGroupExampleInput">
            </div>
            @error('subTitle')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5">{{ $productUpdate->description }}"</textarea>
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="image" class="form-label">Image File</label>
                <span class="description">*Ukuran gambar 1600x900px dan ukuran maksimal 5MB</span>
                <input type="hidden" name="oldImage" value="{{ $productUpdate->image }}">
                @if ($productUpdate->image)
                    <img src="{{ asset('storage/' . $productUpdate->image) }}" alt="image"
                        class="img-preview img-fluid mb-3 d-block">
                @else
                    <img class="img-preview img-fluid mb-3 mt-3">
                @endif
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="image"
                            onchange="previewImage()">
                        <label class="custom-file-label" for="label">Choose file <span class="description">(*.jpeg, .png,
                                .jpg, .gif, .webp)</label>
                    </div>
                </div>
            </div>
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/Product" type="button" class="btn btn-secondary">Back</a>
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
