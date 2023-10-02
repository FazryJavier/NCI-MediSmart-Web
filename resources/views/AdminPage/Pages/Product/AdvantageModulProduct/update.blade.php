@extends('AdminPage.Layouts.master')

@section('title')
    Page Product - Advantage Modul
@endsection

@section('content')
    <section class="content">
        <form action="{{ url('/AdvantageModulProduct/' . $advantageModulProduct->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="modulId" class="form-label">Modul Id</label>
                <select name="modulId" class="custom-select rounded-0" id="modulId">
                    <option value="">Select a Modul</option>
                    @foreach ($modulProducts as $modulProduct)
                        <option value="{{ $modulProduct->id }}" @if ($modulProduct->id == $advantageModulProduct->modulId) selected @endif>
                            {{ $modulProduct->title }}</option>
                    @endforeach
                </select>
            </div>
            @error('modulId')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="icon" class="form-label">Icon File</label>
                <span class="description">*Ukuran gambar 300x370px dan ukuran maksimal 5MB</span>
                <input type="hidden" name="oldImage" value="{{ $advantageModulProduct->icon }}">
                @if ($advantageModulProduct->icon)
                    <img src="{{ asset('storage/' . $advantageModulProduct->icon) }}" alt="image"
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
                <label for="title" class="form-label">Title</label>
                <input type="text" value="{{ $advantageModulProduct->title }}" name="title" class="form-control"
                    id="formGroupExampleInput">
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5">{{ $advantageModulProduct->description }}"</textarea>
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/AdvantageModulProduct" type="button" class="btn btn-secondary">Back</a>
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
