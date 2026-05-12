@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-header justify-content-center">
                <h1>Data Peminjaman</h1>
            </div>

            <div class="section-body">
                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">List Peminjaman Aktif</h4>
                        <a href="{{ route('peminjam.create') }}" class="btn btn-primary">+ Tambah</a>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-peminjaman">

                                <thead class="text-center">
                                    <tr class="bg-primary">
                                        <th class="text-white">No</th>
                                        <th class="text-white">Nama Peminjam</th>
                                        <th class="text-white">Alat</th>
                                        <th class="text-white">Tanggal Pinjam</th>
                                        <th class="text-white">Batas Pengembalian</th>
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
                                            <td>
                                                @if($p->tgl_pengembalian)
                                                    @if(\Carbon\Carbon::parse($p->tgl_pengembalian)->lt(now()))
                                                        <span class="text-danger font-weight-bold">
                                                            {{ $p->tgl_pengembalian }}
                                                            <small>(Telat)</small>
                                                        </span>
                                                    @else
                                                        {{ $p->tgl_pengembalian }}
                                                    @endif
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>

                                            <td class="text-center">
                                                <span class="badge badge-warning">Dipinjam</span>
                                            </td>

                                            <td class="text-center">
                                                <form action="{{ route('peminjam.kembali', $p->id_peminjam) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    <button class="btn btn-success btn-sm"
                                                            onclick="return confirm('Tandai alat ini sudah dikembalikan?')">
                                                        <i class="fas fa-undo"></i> Kembalikan
                                                    </button>
                                                </form>

                                                <a href="{{ route('peminjam.edit', $p->id_peminjam) }}"
                                                   class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                <form action="{{ route('peminjam.destroy', $p->id_peminjam) }}" method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"
                                                            onclick="return confirm('Hapus data ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                <i class="fas fa-check-circle text-success"></i>
                                                Tidak ada peminjaman aktif.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>

                        {{-- PAGINATION --}}
                        <div class="mt-3 d-flex justify-content-end">
                            {{ $peminjams->links() }}
                        </div>

                    </div>

                </div>
            </div>

        </section>
    </div>
@endsection