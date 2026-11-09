@extends('AdminPage.Layouts.master')

@section('title')
    Pengguna
@endsection

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-right mb-2">
                <a class="btn btn-success" href="/Users/create">Tambah Pengguna</a>
            </div>
        </div>
    </div>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th class="col-sm-1">No</th>
                <th>Username</th>
                <th class="col-sm-2">Level</th>
                <th class="col-sm-2">Dibuat</th>
                <th class="col-sm-2">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $key => $item)
                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>
                        {{ $item->username }}
                        @if ($item->id === Auth::id())
                            <span class="badge badge-info">Anda</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $item->level === 'Admin' ? 'badge-primary' : 'badge-secondary' }}">{{ $item->level }}</span>
                    </td>
                    <td>{{ $item->created_at?->format('d M Y') }}</td>
                    <td>
                        <form action="/Users/{{ $item->id }}" method="POST">
                            <a href="/Users/{{ $item->id }}/update" class="btn btn-warning"><i
                                    class="fa-solid fa-pen-to-square"></i></a>
                            @csrf
                            @method('delete')
                            @if ($item->id !== Auth::id())
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Hapus akun {{ $item->username }}?')">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            @endif
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
