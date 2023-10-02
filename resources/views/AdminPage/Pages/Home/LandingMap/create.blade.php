@extends('AdminPage.Layouts.master')

@section('title')
    Page Home - Map
@endsection

@section('content')
    <section class="content">
        <form action="/LandingMap" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="formGroupExampleInput">
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="image" class="form-label">Image File</label>
                <span class="description">*Ukuran gambar 1920x765px dan ukuran maksimal 5MB</span>
                <img class="img-preview img-fluid mb-3 mt-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
                        <label class="custom-file-label" for="image">Choose file <span class="description">(*.jpeg, .png,
                                .jpg, .gif, .webp)</span></label>
                    </div>
                </div>
            </div>
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Create</button>
                <a href="/LandingMap" type="button" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </section>

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
@endsection
