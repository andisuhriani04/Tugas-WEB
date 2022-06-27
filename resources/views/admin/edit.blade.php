@extends('layouts/crud')
@section('content')
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Ubah</h1>
<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Data Menu</h6>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.update',['menu'=>$menu->kode_menu]) }}" method="post"
            enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="form-group">
                <label for="kode_menu">Kode Menu</label>
                <input type="text" class="bg-white form-control" id="kode_menu" name="kode_menu"
                    value="{{ $menu->kode_menu }}" readonly>
            </div>
            <div class="form-group">
                <label for="nama_menu">Nama Menu</label>
                <input type="text" class="form-control @error('nama_menu')is-invalid @enderror" id="nama_menu"
                    name="nama_menu" value="{{ old('nama_menu',$menu->nama_menu) }}">
                @error('nama_menu')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="harga">Harga</label>
                <input type="number" class="form-control @error('harga')is-invalid @enderror" id="harga" name="harga"
                    value="{{ old('harga',$menu->harga) }}">
                @error('harga')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="kategori">Kategori</label>
                <select class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori">
                    <option hidden selected></option>
                    @foreach ($kategori as $item)
                    @if (old('kategori',$menu->kategori)==$item)
                    <option value="{{ $item }}" selected>{{ $item }}</option>
                    @else
                    <option value="{{ $item }}">{{ $item }}</option>
                    @endif
                    @endforeach
                </select>
                @error('kategori')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <div class="form-group">
                <label for="foto">Foto</label>
                <input type="file" class="form-control @error('foto')is-invalid @enderror" id="foto" name="foto"
                    value="{{ old('foto') }}">
                @error('foto')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>
            <button type="submit" class="mt-2 col-12 d-none d-sm-inline-block btn btn-warning text-white shadow-sm">
                <i class="fas fa-pen-square mr-2"></i>Ubah Menu
            </button>
        </form>
    </div>
</div>

@endsection