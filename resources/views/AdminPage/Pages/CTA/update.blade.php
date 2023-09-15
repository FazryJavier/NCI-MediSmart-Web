@extends('AdminPage.Layouts.master')

@section('title')
    Page CTA
@endsection

@section('content')
    <section class="content">
        <form action="{{ url('/CTA/' . $cta->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="image" class="form-label">Image File</label>
                <input type="hidden" name="oldImage" value="{{ $cta->image }}">
                @if ($cta->image)
                    <img src="{{ asset('storage/' . $cta->image) }}" alt="image"
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
                        <label class="custom-file-label" for="label">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" value="{{ $cta->title }}" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label for="caption" class="form-label">Description</label>
                <input type="text" value="{{ $cta->description }}" name="description" class="form-control">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/CTA" type="button" class="btn btn-secondary">Back</a>
            </div>
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
    </section>
@endsection