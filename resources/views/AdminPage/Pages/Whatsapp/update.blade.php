@extends('AdminPage.Layouts.master')

@section('title')
    Page WhatsApp
@endsection

@section('content')
    <form method="POST" action="{{ url('/Whatsapp/' . $whatsappUpdate->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="phone_number" class="form-label">Phone Number</label>
            <input type="text" value="{{ $whatsappUpdate->phone_number }}" name="phone_number" class="form-control">
        </div>
        {{-- @error('judul')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror --}}

        <button type="submit" class="btn btn-success">Update</button>
        <a href="/Whatsapp" type="button" class="btn btn-secondary">Back</a>
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
@endsection
