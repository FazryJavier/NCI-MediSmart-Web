@extends('AdminPage.Layouts.master')

@section('title')
    Footer
@endsection

@section('content')
    <section class="content">
        <form action="{{ url('/Footer/' . $footer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="address_head" class="form-label">Address Head Office</label>
                <input type="text" value="{{ $footer->address_head }}" name="address_head" class="form-control"
                    id="formGroupExampleInput">
            </div>
            @error('address_head')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="phone_head" class="form-label">Phone Head Office</label>
                <input type="text" value="{{ $footer->phone_head }}" name="phone_head" class="form-control"
                    id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="fax_address" class="form-label">Fax Head Office</label>
                <input type="text" value="{{ $footer->fax_address }}" name="fax_address" class="form-control"
                    id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="address_branch" class="form-label">Address Branch Office</label>
                <input type="text" value="{{ $footer->address_branch }}" name="address_branch" class="form-control"
                    id="formGroupExampleInput">
            </div>
            @error('address_branch')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="phone_branch" class="form-label">Phone Branch Office</label>
                <input type="text" value="{{ $footer->phone_branch }}" name="phone_branch" class="form-control"
                    id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="fax_branch" class="form-label">Fax Branch Office</label>
                <input type="text" value="{{ $footer->fax_branch }}" name="fax_branch" class="form-control"
                    id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/Footer" type="button" class="btn btn-secondary">Back</a>
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
    </section>
@endsection
