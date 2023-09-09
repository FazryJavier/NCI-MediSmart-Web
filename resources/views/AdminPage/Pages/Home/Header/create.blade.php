@extends('AdminPage.Layouts.master')

@section('title')
    Create - Section Header
@endsection

@section('content')
    <section class="content">
        <form action="/LandingSlider" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="caption" class="form-label">Sub Judul</label>
                <input type="text" name="caption" class="form-control" id="formGroupExampleInput2">
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Image File</label>
                <img class="img-preview img-fluid mb-3 mt-3">
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
            {{-- <div class="mb-3">
                <label>Tampilkan ?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadio" id="radioYes" value="yes">
                    <label class="form-check-label" for="radioYes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadio" id="radioNo" value="no">
                    <label class="form-check-label" for="radioNo">No</label>
                </div>
            </div> --}}
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Create</button>
                <a href="/LandingSlider" type="button" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </section>
    <script>
        function previewImage()
        {
            const image = document.querySelector('#image');
            const  imgPreview = document.querySelector('.img-preview');

            imgPreview.style.display = 'block';

            const  oFReader = new FileReader();
            oFReader.readAsDataURL(image.files[0]);

            oFReader.onload = function(oFREvent)
            {
                imgPreview.src = oFREvent.target.result;
            }
        }
    </script>
@endsection
