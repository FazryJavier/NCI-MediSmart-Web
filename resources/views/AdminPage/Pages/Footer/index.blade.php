@extends('AdminPage.Layouts.master')

@section('title')
    Footer
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
                <a class="btn btn-success" href="/Footer/create"> Create </a>
            </div>
        </div>
    </div>

    <table id="example1" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="col-sm-1">No</th>
                <th class="col-sm-1">Id</th>
                <th class="col-sm-2">Address Head</th>
                <th class="col-sm-1">Phone Head</th>
                <th class="col-sm-1">Fax Head</th>
                <th class="col-sm-2">Address Branch</th>
                <th class="col-sm-2">Phone Branch</th>
                <th class="col-sm-1">Fax Branch</th>
                <th class="col-sm-1">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($footer as $footer => $item)
                <tr>
                    <td>{{ $footer + 1 }}</td>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->address_head }}</td>
                    <td>{{ $item->phone_head }}</td>
                    <td>{{ $item->fax_head }}</td>
                    <td>{{ $item->address_branch }}</td>
                    <td>{{ $item->phone_branch }}</td>
                    <td>{{ $item->fax_branch }}</td>
                    <td>
                        <form action="/Footer/{{ $item->id }}" method="POST">
                            <a href="/Footer/{{ $item->id }}/update" type="button" class="btn btn-warning"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('Are you sure want to delete this data?')">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <h1>Data is Empty</h1>
            @endforelse
        </tbody>
    </table>
@endsection
