@extends('AdminPage.Layouts.master')

@section('title')
    Page Home - Experience
@endsection

@section('content')
    <section class="content">
        <form action="{{ url('/Experience/' . $experienceUpdate->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" value="{{ $experienceUpdate->title }}" name="title" class="form-control">
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5">{{ $experienceUpdate->description }}</textarea>
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/Experience" type="button" class="btn btn-secondary">Back</a>
            </div>
        </form>
    </section>
@endsection
