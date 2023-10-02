@extends('AdminPage.Layouts.master')

@section('title')
    Footer
@endsection

@section('content')
    <section class="content">
        <form action="/Footer" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="address_head" class="form-label">Address Head Office</label>
                <input type="text" name="address_head" class="form-control" id="formGroupExampleInput">
            </div>
            @error('address_head')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="phone_head" class="form-label">Phone Head Office</label>
                <span class="description">*Tambahkan tulisan 'Phone. '</span>
                <input type="text" name="phone_head" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="fax_address" class="form-label">Fax Head Office</label>
                <span class="description">*Tambahkan tulisan 'Fax. '</span>
                <input type="text" name="fax_address" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="address_branch" class="form-label">Address Branch Office</label>
                <input type="text" name="address_branch" class="form-control" id="formGroupExampleInput">
            </div>
            @error('address_branch')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="phone_branch" class="form-label">Phone Branch Office</label>
                <span class="description">*Tambahkan tulisan 'Phone. '</span>
                <input type="text" name="phone_branch" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="fax_branch" class="form-label">Fax Branch Office</label>
                <span class="description">*Tambahkan tulisan 'Fax. '</span>
                <input type="text" name="fax_branch" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Create</button>
                <a href="/Footer" type="button" class="btn btn-secondary">Back</a>
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
@endsection
