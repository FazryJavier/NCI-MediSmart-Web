@extends('AdminPage.Layouts.master')

@section('title')
    Update - Section Header
@endsection

@section('content')
    <section class="content">
        <form action="/LandingPage-Header" method="GET">
            <div class="mb-3">
                <label for="formGroupExampleInput" class="form-label">Judul</label>
                <input type="text" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="formGroupExampleInput2" class="form-label">Sub Judul</label>
                <input type="text" class="form-control" id="formGroupExampleInput2">
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
                    <input class="form-check-input" type="radio" name="inlineRadio" id="radioYes" value="yes">
                    <label class="form-check-label" for="radioYes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadio" id="radioNo" value="no">
                    <label class="form-check-label" for="radioNo">No</label>
                </div>
            </div>
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/LandingPage-Header" type="button" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </section>
@endsection
