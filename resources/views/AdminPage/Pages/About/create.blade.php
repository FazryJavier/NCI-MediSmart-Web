@extends('AdminPage.Layouts.master')

@section('title')
    Page About Us
@endsection

@section('content')
    <form method="POST" action="/AboutUs" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="mb-3">
            <label for="video" class="form-label">Video</label>
            <span class="description">*Masukkan token yang ada pada link youtube. Ex :
                https://www.youtube.com/watch?v=<b>JzmHxafphj0</b>&ab_channel=SIMRSNCIMediSmart = <b>Token :
                    JzmHxafphj0</b></span>
            <input type="text" name="video" class="form-control">
        </div>
        @error('video')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="image" class="form-label">Upload Logo</label>
            <span class="description">*Ukuran gambar 600x312px dan ukuran maksimal 5MB</span>
            <img class="img-preview img-fluid mb-3 mt-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
                    <label class="custom-file-label" for="image">Choose file <span class="description">(*.jpeg,
                            *.png, *.jpg, *.webp)</label>
                </div>
            </div>
        </div>
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="5"></textarea>
        </div>
        @error('description')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="visi" class="form-label">Visi</label>
            <input type="text" name="visi" class="form-control">
        </div>
        @error('visi')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="mb-3">
            <label for="misi" class="form-label">Misi</label>
            <textarea name="misi" class="form-control" rows="5"></textarea>
        </div>
        @error('misi')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-success">Create</button>
        <a href="/AboutUs" type="button" class="btn btn-secondary">Back</a>
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
@endsection
