@extends('admin.layouts.app')

@section('content')
<div class="main-content">
<section class="section">

    <div class="section-header justify-content-center">
        <h1>Halaman Pengembalian</h1>
    </div>

    <div class="section-body">
        <div class="card">

            <div class="card-header">
                <h4>Data Peminjaman Belum Dikembalikan</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">

                        <thead class="text-center">
                            <tr class="bg-primary">
                                <th class="text-white">No</th>
                                <th class="text-white">Nama Peminjam</th>
                                <th class="text-white">Alat</th>
                                <th class="text-white">Tgl Pinjam</th>
                                <th class="text-white">Batas Kembali</th>
                                <th class="text-white">Status</th>
                                <th class="text-white">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($peminjams as $i => $p)
                            <tr>
                                <td>{{ $peminjams->firstItem() + $i }}</td>
                                <td>{{ $p->user->nama ?? '-' }}</td>
                                <td>{{ $p->alat->nama_alat ?? '-' }}</td>
                                <td>{{ $p->tgl_pinjam }}</td>
                                <td>{{ $p->tgl_pengembalian ?? '-' }}</td>

                                <td>
                                    @if($p->tgl_pengembalian && now()->gt($p->tgl_pengembalian))
                                        <span class="badge badge-danger">Telat</span>
                                    @else
                                        <span class="badge badge-warning">Dipinjam</span>
                                    @endif
                                </td>

                                <td>
                                    <form action="{{ route('peminjam.kembali', $p->id_peminjam) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-success btn-sm"
                                                onclick="return confirm('Tandai alat ini sudah dikembalikan?')">
                                            <i class="fas fa-undo"></i> Kembalikan
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted">
                                    Tidak ada peminjaman yang belum dikembalikan.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                <div class="mt-3 d-flex justify-content-end">
                    {{ $peminjams->links() }}
                </div>

            </div>
        </div>
    </div>

</section>
</div>
@endsection