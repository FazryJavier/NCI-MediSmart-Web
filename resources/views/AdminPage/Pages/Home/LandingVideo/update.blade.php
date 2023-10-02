@extends('AdminPage.Layouts.master')

@section('title')
    Page Home - Landing Video
@endsection

@section('content')
    <section class="content">
        <form action="{{ url('/LandingVideo/' . $videoUpdate->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" value="{{ $videoUpdate->title }}" name="title" class="form-control">
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5">{{ $videoUpdate->description }}</textarea>
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="video" class="form-label">Video</label>
                <span class="description">*Masukkan token yang ada pada link youtube. Ex :
                    https://www.youtube.com/watch?v=<b>JzmHxafphj0</b>&ab_channel=SIMRSNCIMediSmart = <b>Token :
                        JzmHxafphj0</b></span>
                <input type="text" value="{{ $videoUpdate->video }}" name="video" class="form-control">
            </div>
            @error('video')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/LandingVideo" type="button" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </section>

    <style>
        .description {
            font-size: 14px;
            color: #888;
        }
    </style>
@endsection
