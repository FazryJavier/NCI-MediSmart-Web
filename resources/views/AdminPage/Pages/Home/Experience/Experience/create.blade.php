@extends('AdminPage.Layouts.master')

@section('title')
    Page Home - Experience
@endsection

@section('content')
    <section class="content">
        <form action="/Experience" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <div id="editor1"></div>
                <textarea name="title" id="title" style="display: none;"></textarea>
            </div>
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <div id="editor2"></div>
                <textarea name="description" id="description" style="display: none;"></textarea>
            </div>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <button type="submit" class="btn btn-success">Create</button>
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
                        const description = editor.getData();
                        document.querySelector('#description').value = description;
                    });
                })
                .catch(error => {
                    console.error(error);
                });
        </script>
    </section>
@endsection
