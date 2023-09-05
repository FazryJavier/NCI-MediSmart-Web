@extends('AdminPage.Layouts.master')

@section('title')
    Home - Section Client
@endsection

@section('content')
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="col-sm-1">No</th>
                <th class="col-sm-4">Judul</th>
                <th class="col-sm-4">Gambar</th>
                <th class="col-sm-1">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Layanan kesehatan yang bekerja sama dengan kami</td>
                <td>/Image/client.png</td>
                <td> <a type="button" class="btn btn-warning" href="admin-update"><i class="fa-solid fa-pen-to-square"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
