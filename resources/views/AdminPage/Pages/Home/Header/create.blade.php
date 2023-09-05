@extends('AdminPage.Layouts.master')

@section('title')
    Create - Section Header
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="/LandingPage-Header/create"> Create </a>
            </div>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="col-sm-1">No</th>
                <th class="col-sm-4">Judul</th>
                <th class="col-sm-4">Sub Judul</th>
                <th class="col-sm-2">Gambar</th>
                <th class="col-sm-1">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>@mdo</td>
                <td> <a type="button" class="btn btn-warning" href="admin-update"><i
                            class="fa-solid fa-pen-to-square"></i></a>
                    <a type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
