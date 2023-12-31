@extends('AdminPage.Layouts.master')

@section('title')
    Page Product - Detail Product
@endsection

@section('content')
    <section class="content">
        <form action="/DetailProduct" method="POST" enctype="multipart/form-data">
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
            @error('productId')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="logo" class="form-label">Logo File</label>
                <span class="description">*Ukuran gambar 1920x347px dan ukuran maksimal 5MB</span>
                <img class="img-preview img-fluid mb-3 mt-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="form-control" id="image" name="logo" onchange="previewImage()">
                        <label class="custom-file-label" for="image">Choose file <span class="description">(*.jpeg, .png,
                                .jpg, .gif, .webp)</label>
                    </div>
                </div>
            </div>
            @error('logo')
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
                <label for="flyer" class="form-label">Link Flyer</label>
                <input type="text" name="flyer" class="form-control" id="formGroupExampleInput">
            </div>
            @error('flyer')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="video" class="form-label">Video</label>
                <span class="description">*Masukkan token yang ada pada link youtube. Ex :
                    https://www.youtube.com/watch?v=<b>JzmHxafphj0</b>&ab_channel=SIMRSNCIMediSmart = <b>Token :
                        JzmHxafphj0</b></span>
                <input type="text" name="video" class="form-control" id="formGroupExampleInput">
            </div>
            @error('video')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="moduldesc" class="form-label">Modul Description</label>
                <div id="editor1"></div>
                <textarea name="moduldesc" id="moduldesc" style="display: none;"></textarea>
            </div>
            @error('moduldesc')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Create</button>
                <a href="/DetailProduct" type="button" class="btn btn-secondary">Back</a>
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
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    const moduldesc = editor.getData();
                    document.querySelector('#moduldesc').value = moduldesc;
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
