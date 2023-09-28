@extends('AdminPage.Layouts.master')

@section('title')
    Page Product - Advantage List
@endsection

@section('content')
    <section class="content">
        <form action="/AdvantageListProduct" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="advantageId" class="form-label">Advantage Id</label>
                <select name="advantageId" class="custom-select rounded-0" id="advantageId">
                    <option value="">Select a Advantage</option>
                    @foreach ($advantageProducts as $advantageProduct)
                        <option value="{{ $advantageProduct->id }}">{{ $advantageProduct->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <span class="description">*Pisahkan dengan titik koma (;) jika yang diinputkan ingin langsung seluruh list,
                    contoh : Satu;Dua;Tiga</span>
                <input type="text" name="name" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Create</button>
                <a href="/AdvantageListProduct" type="button" class="btn btn-secondary">Back</a>
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
