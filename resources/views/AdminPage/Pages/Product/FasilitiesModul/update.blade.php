@extends('AdminPage.Layouts.master')

@section('title')
    Page Product - Fasilities Modul
@endsection

@section('content')
    <section class="content">
        <form action="{{ url('/FasilitiesModulProduct/' . $facilitiesModulProduct->id) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="modulId" class="form-label">Modul Id</label>
                <select name="modulId" class="custom-select rounded-0" id="modulId">
                    <option value="">Select a Modul</option>
                    @foreach ($modulProducts as $modulProduct)
                        <option value="{{ $modulProduct->id }}" @if ($modulProduct->id == $facilitiesModulProduct->modulId) selected @endif>
                            {{ $modulProduct->title }}</option>
                    @endforeach
                </select>
            </div>
            @error('modulId')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" value="{{ $facilitiesModulProduct->description }}" name="description"
                    class="form-control" id="formGroupExampleInput">
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="list" class="form-label">List</label>
                <span class="description">*List Diisi dengan 1-2 (1 : List bagian atas, 2 : List bagian bawah)</span>
                <input type="text" value="{{ $facilitiesModulProduct->list }}" name="list" class="form-control"
                    id="formGroupExampleInput">
            </div>
            @error('list')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/FasilitiesModulProduct" type="button" class="btn btn-secondary">Back</a>
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
