@extends('layouts/index')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Beranda</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Menu</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.create') }}" method="get">
            @csrf
            <button type="submit" class="mb-4 col-12 d-none d-sm-inline-block btn btn-success shadow-sm">
                <i class="fas fa-plus-square mr-2"></i>Tambah Menu
            </button>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode Menu</th>
                        <th>Nama Menu</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Foto</th>
                        <th>Ubah</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th colspan="8">Scrumptious</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($menu as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $item->kode_menu }}</td>
                        <td>{{ $item->nama_menu }}</td>
                        <td>{{ $item->harga }}</td>
                        <td>{{ $item->kategori }}</td>
                        @if ($item->foto)
                        <td>
                            <a href="{{ asset('storage/'.$item->foto) }}" target="_blank">
                                <button type="submit" class="btn btn-info btn-circle">
                                    <i class="fas fa-image"></i>
                                </button>
                            </a>
                        </td>
                        @else
                        <td>
                            <button type="button" class="btn btn-secondary btn-circle"
                                onclick="return alert('Foto tidak tersedia!')">
                                <i class="fas fa-image"></i>
                            </button>
                        </td>
                        @endif
                        <td>
                            <form action="{{ route('admin.edit', ['menu' => $item->kode_menu]) }}">
                                @csrf
                                <button type="submit" class="btn btn-warning text-white btn-circle">
                                    <i class="fas fa-pen-square"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                            <form action="{{ route('admin.destroy',$item->kode_menu) }}" method="post">
                                @method('delete')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-circle"
                                    onclick="return confirm('Apakah menu akan dihapus?')">
                                    <i class="fas fa-minus-square"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection