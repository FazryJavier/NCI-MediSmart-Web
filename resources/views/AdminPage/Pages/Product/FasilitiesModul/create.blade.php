@extends('AdminPage.Layouts.master')

@section('title')
    Page Product - Fasilities Modul
@endsection

@section('content')
    <section class="content">
        <form action="/FasilitiesModulProduct" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="modulId" class="form-label">Modul Id</label>
                <select name="modulId" class="custom-select rounded-0" id="modulId">
                    <option value="">Select a Modul</option>
                    @foreach ($modulProducts as $modulProduct)
                        <option value="{{ $modulProduct->id }}">{{ $modulProduct->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" name="description" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="list" class="form-label">List</label>
                <input type="text" name="list" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Create</button>
                <a href="/FasilitiesModulProduct" type="button" class="btn btn-secondary">Back</a>
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