@extends('AdminPage.Layouts.master')

@section('title')
    Update - Section Client
@endsection

@section('content')
    <section class="content">
        <form action="/LandingPage-Header" method="GET">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Judul</label>
                <input type="text" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="formFile" class="form-label">Image File</label>
                <div class="input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                    </div>
                    <div class="custom-file">
                        <input type="file" class="custom-file-input"
                            id="inputGroupFile01"aria-describedby="inputGroupFileAddon01">
                        <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label>Tampilkan ?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                    <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                    <label class="form-check-label" for="inlineCheckbox2">No</label>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/LandingPage-Client" type="button" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </section>
@endsection
