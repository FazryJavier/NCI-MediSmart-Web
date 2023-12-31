@extends('AdminPage.Layouts.master')

@section('title')
    Page Home - Landing Slider
@endsection

@section('content')
    <section class="content">
        <form action="/LandingSlider" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-control" id="formGroupExampleInput">
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="caption" class="form-label">Caption</label>
                <div id="editor1"></div>
                {{-- <input type="text" name="caption" class="form-control" id="formGroupExampleInput2"> --}}
                <textarea name="caption" id="caption" style="display: none;"></textarea>
            </div>
            @error('caption')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="image" class="form-label">Image File</label>
                <span class="description">*Ukuran gambar 1600x900px dan ukuran maksimal 5MB</span>
                <img class="img-preview img-fluid mb-3 mt-3">
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="form-control" id="image" name="image" onchange="previewImage()">
                        <label class="custom-file-label" for="image">Choose file <span class="description">(*.jpeg, .png,
                                .jpg, .gif, .webp)</span></label>
                    </div>
                </div>
            </div>
            @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="link" class="form-label">Link Button</label>
                <input type="text" name="link" class="form-control" id="formGroupExampleInput">
                <ul>
                    <li class="description">Untuk Mengakses Link Produk: /ProductView/id</li>
                    <li class="description">Untuk Mengakses Link Modul: /Modul/id</li>
                    <li class="description">Untuk Mengakses Link Testimoni: /Testimoni</li>
                    <li class="description">Untuk Mengakses Link Blog: /Blog</li>
                    <li class="description">Untuk Mengakses Link Detail pada Blog: /DetailBlog/id</li>
                </ul>
            </div>
            @error('link')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="1" name="status" id="show" checked>
                    <label class="form-check-label" for="show">
                        Show Data
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" value="0" name="status" id="hide">
                    <label class="form-check-label" for="hide">
                        Hide Data
                    </label>
                </div>
            </div>
            <input type="hidden" name="status" id="selected_status" value="1">
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Create</button>
                <a href="/LandingSlider" type="button" class="btn btn-secondary">Back</a>
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

        // JavaScript function to update the hidden input with the selected status
        function updateStatus() {
            var selectedStatus = document.querySelector('input[name="status"]:checked').value;
            document.getElementById('selected_status').value = selectedStatus;
        }

        // Attach the updateStatus function to the radio buttons' onchange event
        document.querySelectorAll('input[name="status"]').forEach(function(radio) {
            radio.addEventListener('change', updateStatus);
        });
    </script>
    <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create(document.querySelector('#editor1'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    const caption = editor.getData();
                    document.querySelector('#caption').value = caption;
                });
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endsection
