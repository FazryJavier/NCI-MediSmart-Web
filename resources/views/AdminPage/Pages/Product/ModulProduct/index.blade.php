@extends('AdminPage.Layouts.master')

@section('title')
    Page Product - Modul
@endsection

@push('script')
    <script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable();
        });
    </script>
@endpush

@push('style')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.11.3/datatables.min.css" />
@endpush

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="/ModulProduct/create"> Create </a>
            </div>
        </div>
    </div>

    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="col-sm-1">Id</th>
                <th class="col-sm-2">Product Name</th>
                <th class="col-sm-2">Title</th>
                <th class="col-sm-2">Description</th>
                <th class="col-sm-3">Icon</th>
                <th class="col-sm-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($modulProduct as $modulProduct => $item)
                <tr>
                    <td>{{ $modulProduct + 1 }}</td>
                    <td>{{ $item->products->title }}</td>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->description }}</td>
                    <td><img src="{{ asset('storage/' . $item->icon) }}" alt="Image" class="img-fluid mt-3"></td>
                    <td>
                        <form action="/ModulProduct/{{ $item->id }}" method="POST">
                            <a href="/ModulProduct/{{ $item->id }}/update" type="button" class="btn btn-warning"><i
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
