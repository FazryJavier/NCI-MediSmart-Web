@extends('AdminPage.Layouts.master')

@section('title')
    Home - Section Header
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="/LandingSlider/create"> Create </a>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="col-sm-1">ID</th>
                <th class="col-sm-4">Title</th>
                <th class="col-sm-4">Caption</th>
                <th class="col-sm-2">Image</th>
                <th class="col-sm-1">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($landing as $ld =>$item)
            <tr>
                {{-- <th scope="row">1</th> --}}
                <td>{{  $ld + 1 }}</td>
                <td>{{ $item->title }}</td>
                <td>{{ $item->caption }}</td>
                <td><img src="{{ asset('storage/'. $item->image) }}" alt="Image" class="img-fluid mt-3"></td>
                <td> 
                    {{-- <a type="button" class="btn btn-warning" href="/LandingPage-Header/update"><i
                            class="fa-solid fa-pen-to-square"></i></a>
                    <a type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a> --}}
                    <form action="/LandingSlider/{{ $item->id }}" method="POST">
                        <a href="/LandingSlider/{{ $item->id }}/update" type="button" class="btn btn-warning"><i
                                class="fa-solid fa-pen-to-square"></i></a>
                        @csrf
                        @method('delete')
                        <input type="submit" value='Delete' class="btn btn-danger mt-1"
                            onclick="return confirm('Are you sure want to delete this data?')">
                    </form>
                </td>
            </tr>
            @empty
            <h1>Data is Empty</h1>
        @endforelse
        </tbody>
    </table>
@endsection
