@extends('AdminPage.Layouts.master')

@section('title')
    Page Product - Detail Product
@endsection

@section('content')
    <section class="content">
        <form action="{{ url('/DetailProduct/' . $detailProduct->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="productId" class="form-label">Product Id</label>
                <select name="productId" class="custom-select rounded-0" id="productId">
                    <option value="">Select a Product</option>
                    @foreach ($products as $product)
                        <option value="{{ $product->id }}" @if ($product->id == $detailProduct->productId) selected @endif>
                            {{ $product->title }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label">Image File</label>
                <span class="description">*Ukuran gambar 1920x347px dan ukuran maksimal 5MB</span>
                <input type="hidden" name="oldImage" value="{{ $detailProduct->logo }}">
                @if ($detailProduct->logo)
                    <img src="{{ asset('storage/' . $detailProduct->logo) }}" alt="image"
                        class="img-preview img-fluid mb-3 d-block">
                @else
                    <img class="img-preview img-fluid mb-3 mt-3">
                @endif
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="image" name="logo"
                            onchange="previewImage()">
                        <label class="custom-file-label" for="label">Choose file <span class="description">(*.jpeg, .png,
                                .jpg, .gif, .webp)</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5">{{ $detailProduct->description }}</textarea>
            </div>
            <div class="mb-3">
                <label for="flyer" class="form-label">Link Flyer</label>
                <input type="text" value="{{ $detailProduct->flyer }}" name="flyer" class="form-control"
                    id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="video" class="form-label">Video</label>
                <span class="description">*Masukkan token yang ada pada link youtube. Ex :
                    https://www.youtube.com/watch?v=<b>JzmHxafphj0</b>&ab_channel=SIMRSNCIMediSmart = <b>Token :
                        JzmHxafphj0</b></span>
                <input type="text" value="{{ $detailProduct->video }}" name="video" class="form-control"
                    id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/DetailProduct" type="button" class="btn btn-secondary">Back</a>
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
