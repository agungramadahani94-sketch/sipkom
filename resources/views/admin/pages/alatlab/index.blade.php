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

                        {{-- SEARCH --}}
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <form method="GET" action="{{ route('alatlab.index') }}">
                                    <input type="text" name="search" class="form-control"
                                        placeholder="Cari nama alat atau kategori..." value="{{ $search ?? '' }}">
                                </form>
                            </div>
                        </div>

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
                                                        style="width:100px; height:80px; object-fit:cover;">
                                                @else
                                                    <span class="text-muted">Tidak ada gambar</span>
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

                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="confirmDelete(this)">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>

                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Data tidak ada</td>
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

    {{-- SUCCESS ALERT --}}
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 2000
            });
        </script>
    @endif

    {{-- DELETE CONFIRM SWEETALERT --}}
    <script>
        function confirmDelete(btn) {
            Swal.fire({
                title: 'Yakin hapus data?',
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    btn.closest('form').submit();
                }
            });
        }
    </script>

@endsection