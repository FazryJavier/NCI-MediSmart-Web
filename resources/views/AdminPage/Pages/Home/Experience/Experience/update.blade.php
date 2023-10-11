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
                <div id="editor1"></div>
                {{-- <input type="text" value="{{ $experienceUpdate->title }}" name="title" class="form-control"> --}}
                <textarea name="title" id="title" style="display: none;" value="{{ $experienceUpdate->title }}"></textarea>
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <div id="editor2"></div>
                <textarea name="description" id="description" style="display: none;" value="{{ $experienceUpdate->description }}"></textarea>
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Update</button>
                <a href="/Experience" type="button" class="btn btn-secondary">Back</a>
            </div>
        </form>
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor1'))
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        const title = editor.getData();
                        document.querySelector('#title').value = title;
                    });

                    const initalTitle = "{!! addslashes($experienceUpdate->title) !!}";
                    editor.setData(initalTitle);
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
        <script src="https://cdn.ckeditor.com/ckeditor5/36.0.1/classic/ckeditor.js"></script>
        <script>
            ClassicEditor
                .create(document.querySelector('#editor2'))
                .then(editor => {
                    editor.model.document.on('change:data', () => {
                        const title = editor.getData();
                        document.querySelector('#description').value = title;
                    });

                    const initalDescription = "{!! addslashes($experienceUpdate->description) !!}";
                    editor.setData(initalDescription);
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    </section>
@endsection
