@extends('AdminPage.Layouts.master')

@section('title')
    Page Home - Landing Slider
@endsection

@section('content')
    <section class="content">
        <form action="{{ url('/LandingSlider/' . $slider->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" value="{{ $slider->title }}" name="title" class="form-control">
            </div>

            <div class="mb-3">
                <label for="caption" class="form-label">Sub Judul</label>
                <input type="text" value="{{ $slider->caption }}" name="caption" class="form-control">
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image File</label>
                <span class="description">*Ukuran gambar 5756x3644px atau 16:9 dan ukuran maksimal 2MB</span>
                <input type="hidden" name="oldImage" value="{{ $slider->image }}">
                @if ($slider->image)
                    <img src="{{ asset('storage/' . $slider->image) }}" alt="image"
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
                        <label class="custom-file-label" for="label">Choose file <span class="description">(*.jpeg,
                                *.png, *.jpg)</span></label>
                    </div>
                </div>
                {{-- @if ($slider ->status ==0) --}}
                {{-- <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox"  name="status" id="status">
                        <label class="form-check-label" for="status">
                            Tampilkan Data
                        </label>
                    </div>
                </div> --}}
                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="1" name="status" id="show" {{ $slider->status == 1 ? 'checked' : '' }}>
                        <label class="form-check-label" for="show">Tampilkan Data</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" value="0" name="status" id="hide" {{ $slider->status == 0 ? 'checked' : '' }}>
                        <label class="form-check-label" for="hide">Sembunyikan Data</label>
                    </div>
                </div>
                {{-- @endif --}}
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/LandingSlider" type="button" class="btn btn-secondary">Back</a>
            </div>
        </form>

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
        <script>
            document.addEventListener("DOMContentLoaded", function (){
               const statusCheckBox =  document.getElementById("status");
               const statusValue = "{{ $slider->status }}";
               
               if (statusValue == 1){
                statusCheckBox.checked = true;
               }else{
                statusCheckBox.checked = false;
               }
            });
        </script>
    </section>
@endsection
