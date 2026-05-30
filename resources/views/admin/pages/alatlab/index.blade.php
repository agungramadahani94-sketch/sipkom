@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-header">
                <h1>Halaman Alat Laboratorium</h1>
            </div>

            <div class="section-body">
                <div class="card">

                    <div class="card-header d-flex justify-content-between">
                        <h4>Data Alat Lab</h4>
                        <a href="{{ route('alatlab.create') }}" class="btn btn-primary">
                            + Tambah Data
                        </a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">

                            <table class="table table-bordered table-md">

                                <thead>
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
                                            <td>{{ $alat->firstItem() + $no }}</td>
                                            <td>
                                                @if($a->gambar)
                                                    <img src="{{ asset('storage/' . $a->gambar) }}"
                                                         alt="{{ $a->nama_alat }}"
                                                         style="width:100px; height:80px; object-fit:cover; object-position:center; display:block;">
                                                @else
                                                    <p class="text-muted">Tidak ada gambar</p>
                                                @endif
                                            </td>
                                            <td>{{ $a->nama_alat }}</td>
                                            <td>{{ $a->kategori }}</td>

                                            <td>
                                                @if($a->kondisi == 'baik')
                                                    <span class="badge badge-success">Baik</span>
                                                @elseif($a->kondisi == 'rusak')
                                                    <span class="badge badge-danger">Rusak</span>
                                                @else
                                                    <span class="badge badge-warning">Diperbaiki</span>
                                                @endif
                                            </td>

                                            <td>{{ $a->stok }}</td>

                                            <td>
                                                <a href="{{ route('alatlab.edit', $a->id_alat) }}"
                                                    class="btn btn-warning btn-sm">
                                                    Edit
                                                </a>

                                                <form action="{{ route('alatlab.destroy', $a->id_alat) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Yakin hapus data?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Data tidak ada</td>
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