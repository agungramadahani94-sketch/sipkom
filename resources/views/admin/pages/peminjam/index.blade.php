@extends('admin.layouts.app')

@section('content')
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Halaman Alat Laboratorium</h1>
        </div>

        <div class="section-body">
            <div class="card shadow-sm">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Data Alat Lab</h4>
                    <a href="{{ route('alatlab.create') }}" class="btn btn-primary">
                        + Tambah Data
                    </a>
                </div>

                <div class="card-body">

                    {{-- SEARCH --}}
                    <div class="row mb-3">
                        <div class="col-md-5">
                            <form method="GET" action="{{ route('alatlab.index') }}" class="d-flex">
                                <input type="text"
                                    name="search"
                                    class="form-control mr-2"
                                    placeholder="Cari nama alat atau kategori..."
                                    value="{{ $search ?? '' }}">
                                <button type="submit" class="btn btn-primary">Cari</button>
                                @if(!empty($search))
                                    <a href="{{ route('alatlab.index') }}" class="btn btn-secondary ml-1">Reset</a>
                                @endif
                            </form>
                        </div>
                    </div>

                    {{-- TABLE --}}
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover align-middle">

                            <thead class="text-center">
                                <tr class="bg-primary">
                                    <th class="text-white">No</th>
                                    <th class="text-white">Gambar</th>
                                    <th class="text-white">Nama Alat</th>
                                    <th class="text-white">Kategori</th>
                                    <th class="text-white">Kondisi</th>
                                    <th class="text-white">Stok</th>
                                    <th class="text-white">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @forelse ($alat as $no => $a)
                                <tr>
                                    <td class="text-center">{{ $alat->firstItem() + $no }}</td>

                                    <td class="text-center">
                                        @if($a->gambar)
                                            <img src="{{ asset('storage/' . $a->gambar) }}"
                                                alt="{{ $a->nama_alat }}"
                                                style="width:100px; height:80px; object-fit:cover; border-radius:6px;">
                                        @else
                                            <span class="text-muted">Tidak ada</span>
                                        @endif
                                    </td>

                                    <td>{{ $a->nama_alat }}</td>
                                    <td>{{ $a->kategori }}</td>

                                    <td class="text-center">
                                        @if($a->kondisi == 'baik')
                                            <span class="badge badge-success px-3 py-1">Baik</span>
                                        @elseif($a->kondisi == 'rusak')
                                            <span class="badge badge-danger px-3 py-1">Rusak</span>
                                        @else
                                            <span class="badge badge-warning px-3 py-1">Perbaikan</span>
                                        @endif
                                    </td>

                                    <td class="text-center">{{ $a->stok }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('alatlab.edit', $a->id_alat) }}"
                                            class="btn btn-warning btn-sm mr-1">
                                            <i class="fas fa-edit"></i> Edit
                                        </a>

                                        <form action="{{ route('alatlab.destroy', $a->id_alat) }}"
                                            method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Yakin hapus data ini?')">
                                                <i class="fas fa-trash"></i> Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                @empty
                                <tr>
                                    <td colspan="7" class="text-center text-muted py-4">
                                        <i class="fas fa-inbox"></i>
                                        {{ isset($search) && $search ? 'Data tidak ditemukan untuk "' . $search . '"' : 'Belum ada data alat.' }}
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>

                        </table>
                    </div>
                </div>

                <div class="card-footer text-right">
                    {{ $alat->links() }}
                </div>

            </div>
        </div>

    </section>
</div>
@endsection