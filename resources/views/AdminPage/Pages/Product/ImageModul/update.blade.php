@extends('AdminPage.Layouts.master')

@section('title')
    Page Product - Image Modul
@endsection

@section('content')
    <section class="content">
        <form action="{{ url('/ImageModulProduct/' . $imageModulProduct->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="modulId" class="form-label">Modul Id</label>
                <select name="modulId" class="custom-select rounded-0" id="modulId">
                    <option value="">Select a Modul</option>
                    @foreach ($modulProducts as $modulProduct)
                        <option value="{{ $modulProduct->id }}" @if ($modulProduct->id == $imageModulProduct->modulId) selected @endif>
                            {{ $modulProduct->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image File</label>
                <span class="description">*Ukuran gambar 4320x948px atau 16:9 dan ukuran maksimal 2MB</span>
                <input type="hidden" name="oldImage" value="{{ $imageModulProduct->image }}">
                @if ($imageModulProduct->image)
                    <img src="{{ asset('storage/' . $imageModulProduct->image) }}" alt="image"
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
                        <label class="custom-file-label" for="label">Choose file <span class="description">(*.jpeg,
                                *.png, *.jpg)</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="list" class="form-label">List</label>
                <input type="text" value="{{ $imageModulProduct->list }}" name="list" class="form-control"
                    id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/ImageModulProduct" type="button" class="btn btn-secondary">Back</a>
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
