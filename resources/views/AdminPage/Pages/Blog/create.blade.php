@extends('AdminPage.Layouts.master')

@section('title')
    Page Blog - Article
@endsection
@section('content')
    <section class="content">
        <form action="/Article" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="adminId" class="form-label">Admin Id</label>
                <select name="adminId" class="custom-select rounded-0" id="adminId">
                    <option value="">Select Admin ID </option>
                    @foreach ($users as $user)
                        <option value="{{ $user->id }}">{{ $user->username }}</option>
                    @endforeach
                </select>
            </div>
            @error('adminId')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="title" class="form-label"> Title</label>
                <input type="text" name="title" class="form-control" id="formGroupExampleInput">
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <div id="editor"></div>
                <textarea name="description" id="description" style="display: none;"></textarea>
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="image" class="form-label">Image File</label>
                <span class="description">*Ukuran gambar 1920x900px dan ukuran maksimal 5MB</span>
                <img class="img-preview img-fluid mb-3 mt-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
                        <label class="custom-file-label" for="image">Choose file <span class="description">(*.jpeg,
                                *.png, *.jpg, *.webp)</span></label>
                    </div>
                </div>
            </div>
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="prioritize" class="form-label"> Priority</label>
                <span class="description">*Prioritas Diisi dengan 1-3 (1 : Prioritas, 2 : 3 berita terpanas, 3 : berita
                    lainnya)</span>
                <input type="text" name="prioritize" class="form-control" id="formGroupExampleInput">
            </div>
            @error('prioritiza')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Create</button>
                <a href="/Article" type="button" class="btn btn-secondary">Back</a>
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
            .create(document.querySelector('#editor'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    const description = editor.getData();
                    document.querySelector('#description').value = description;
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
