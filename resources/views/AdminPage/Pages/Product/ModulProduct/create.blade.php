@extends('AdminPage.Layouts.master')

@section('title')
    Page Product - Modul
@endsection

@section('content')
    <section class="content">
        <form action="/ModulProduct" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="productId" class="form-label">Product Id</label>
                <select name="productId" class="custom-select rounded-0" id="productId">
                    <option value="">Select a Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}">{{ $product->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="subTitle" class="form-label">Sub Title</label>
                <input type="text" name="subTitle" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="icon" class="form-label">Icon File</label>
                <img class="img-preview1 img-fluid mb-3 mt-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="form-control" id="image1" name="icon"
                            onchange="previewImage(1)">
                        <label class="custom-file-label" for="image1">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="image_main" class="form-label">Image File</label>
                <img class="img-preview2 img-fluid mb-3 mt-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon02">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="form-control" id="image2" name="image_main"
                            onchange="previewImage(2)">
                        <label class="custom-file-label" for="image2">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Create</button>
                <a href="/ModulProduct" type="button" class="btn btn-secondary">Back</a>
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
