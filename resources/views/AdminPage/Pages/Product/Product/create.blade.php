@extends('AdminPage.Layouts.master')

@section('title')
    Page Product - Product View
@endsection

@section('content')
    <section class="content">
        <form action="/Product" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="subTitle" class="form-label">Sub Title</label>
                <input type="text" name="subTitle" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="image_title" class="form-label">Image Title File</label>
                <img class="img-preview1 img-fluid mb-3 mt-3">
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
                <img class="img-preview2 img-fluid mb-3 mt-3">
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
                <textarea name="description_show" class="form-control" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="description_detail" class="form-label">Description Detail</label>
                <textarea name="description_detail" class="form-control" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="flyer" class="form-label">Flyer</label>
                <input type="text" name="flyer" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="video" class="form-label">Video</label>
                <input type="text" name="video" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Create</button>
                <a href="/Product" type="button" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </section>
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
@endsection
