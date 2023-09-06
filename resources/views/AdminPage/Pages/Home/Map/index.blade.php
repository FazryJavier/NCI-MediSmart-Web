@extends('AdminPage.Layouts.master')

@section('title')
    Home - Section Map
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
                <td>100+ Jumlah client di Indonesia</td>
                <td>/Image/Indonesia.png</td>
                <td> <a type="button" class="btn btn-warning" href="/LandingPage-Map/update"><i class="fa-solid fa-pen-to-square"></i></a>
                </td>
            </tr>
        </tbody>
    </table>
@endsection
