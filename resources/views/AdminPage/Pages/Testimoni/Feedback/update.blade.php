@extends('AdminPage.Layouts.master')

@section('title')
    Page Testimoni - Feedback
@endsection

@section('content')
    <section class="content">
        <form action="{{ url('/Feedback/' . $feedbackUpdate->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="image" class="form-label">Image File</label>
                <input type="hidden" name="oldImage" value="{{ $feedbackUpdate->image }}">
                @if ($feedbackUpdate->image)
                    <img src="{{ asset('storage/' . $feedbackUpdate->image) }}" alt="image"
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
                <label for="name" class="form-label">Name</label>
                <input type="text" value="{{ $feedbackUpdate->name }}" name="name" class="form-control">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5">{{ $feedbackUpdate->description }}</textarea>
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
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/Feedback" type="button" class="btn btn-secondary">Back</a>
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
