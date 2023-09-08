@extends('AdminPage.Layouts.master')

@section('title')
    Page About Us
@endsection

@section('content')
    <form method="POST" action="{{ url('/AboutUs/' . $aboutUpdate->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="video" class="form-label">Video</label>
            <input type="text" value="{{ $aboutUpdate->video }}" name="video" class="form-control">
        </div>
        {{-- @error('judul')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror --}}

        <div class="mb-3">
            <label for="image" class="form-label">Upload Image</label>
            <img class="img-preview img-fluid mb-3 mt-3">
            @if ($aboutUpdate->image)
                <img src="{{ asset('storage/' . $aboutUpdate->image) }}" alt="image"
                    class="img-preview img-fluid mb-3 d-block">
            @else
                <img class="img-preview img-fluid mb-3 mt-3">
            @endif
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                </div>
                <div class="custom-file">
                    <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
                    <label class="custom-file-label" for="image">Choose file</label>
                </div>
            </div>
        </div>
        {{-- @error('poster')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror --}}

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="5">{{ $aboutUpdate->description }}</textarea>
        </div>
        {{-- @error('ringkasan')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror --}}

        <div class="mb-3">
            <label for="visi" class="form-label">Visi</label>
            <input type="text" value="{{ $aboutUpdate->visi }}" name="visi" class="form-control">
        </div>
        {{-- @error('tahun')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror --}}

        <div class="mb-3">
            <label for="misi" class="form-label">Misi</label>
            <input type="text" value="{{ $aboutUpdate->misi }}" name="misi" class="form-control">
        </div>
        {{-- @error('tahun')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror --}}

        <button type="submit" class="btn btn-success">Update</button>
        <a href="/AboutUs" type="button" class="btn btn-secondary">Back</a>
    </form>

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
