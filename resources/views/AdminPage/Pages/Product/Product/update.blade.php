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
            <div class="mb-3">
                <label for="subTitle" class="form-label">Sub Title</label>
                <input type="text" value="{{ $productUpdate->subTitle }}" name="subTitle" class="form-control"
                    id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="image_title" class="form-label">Image Title File</label>
                <input type="hidden" name="oldImage" value="{{ $productUpdate->image_title }}">
                @if ($productUpdate->image_title)
                    <img src="{{ asset('storage/' . $productUpdate->image_title) }}" alt="image"
                        class="img-preview img-fluid mb-3 d-block">
                @else
                    <img class="img-preview img-fluid mb-3 mt-3">
                @endif
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="form-control" id="image1" name="image_title"
                            onchange="previewImage(1)">
                        <label class="custom-file-label" for="image1">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="image_show" class="form-label">Image Show File</label>
                <input type="hidden" name="oldImage" value="{{ $productUpdate->image_show }}">
                @if ($productUpdate->image_show)
                    <img src="{{ asset('storage/' . $productUpdate->image_show) }}" alt="image"
                        class="img-preview img-fluid mb-3 d-block">
                @else
                    <img class="img-preview img-fluid mb-3 mt-3">
                @endif
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="form-control" id="image2" name="image_show"
                            onchange="previewImage(2)">
                        <label class="custom-file-label" for="image2">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="description_show" class="form-label">Description Show</label>
                <textarea name="description_show" class="form-control" rows="5">{{ $productUpdate->description_show }}"</textarea>
            </div>
            <div class="mb-3">
                <label for="description_detail" class="form-label">Description Detail</label>
                <textarea name="description_detail" class="form-control" rows="5">{{ $productUpdate->description_detail }}"</textarea>
            </div>
            <div class="mb-3">
                <label for="flyer" class="form-label">Flyer</label>
                <input type="text" value="{{ $productUpdate->flyer }}" name="flyer" class="form-control"
                    id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="video" class="form-label">Video</label>
                <input type="text" value="{{ $productUpdate->video }}" name="video" class="form-control"
                    id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/Product" type="button" class="btn btn-secondary">Back</a>
            </div>
        </form>
        <script>
            function previewImage(imageNumber) {
                const imageInput = document.querySelector(`#image${imageNumber}`);
                const imgPreview = document.querySelector(`.img-preview${imageNumber}`);

                imgPreview.style.display = 'block';

                const oFReader = new FileReader();
                oFReader.readAsDataURL(imageInput.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.src = oFREvent.target.result;
                }
            }
        </script>
    </section>
@endsection
