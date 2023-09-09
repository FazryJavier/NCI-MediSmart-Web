@extends('AdminPage.Layouts.master')

@section('title')
    Page Home - Landing Video
@endsection

@section('content')
    <section class="content">
        <form action="/LandingVideo" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="title" class="form-label">Judul</label>
                <input type="text" name="title" class="form-control" id="formGroupExampleInput">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5"></textarea>
            </div>
            <div class="mb-3">
                <label for="video" class="form-label">Video</label>
                <input type="text" name="video" class="form-control">
            </div>
            {{-- <div class="mb-3">
                <label>Tampilkan ?</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadio" id="radioYes" value="yes">
                    <label class="form-check-label" for="radioYes">Yes</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadio" id="radioNo" value="no">
                    <label class="form-check-label" for="radioNo">No</label>
                </div>
            </div> --}}
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Create</button>
                <a href="/LandingVideo" type="button" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </section>
@endsection
