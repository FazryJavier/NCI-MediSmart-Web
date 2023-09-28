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
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="caption" class="form-label">Sub Judul</label>
                <input type="text" name="caption" class="form-control" id="formGroupExampleInput2">
            </div>
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
@endsection
