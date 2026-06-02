@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-header justify-content-center">
                <h1>Peminjaman Aktif</h1>
            </div>

            <div class="section-body">
                <div class="card">

                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">
                            <i class="fas fa-hand-holding text-primary mr-1"></i>
                            Sedang Dipinjam
                        </h4>
                        <div>
                            <a href="{{ route('peminjam.index') }}" class="btn btn-warning btn-sm mr-1">
                                <i class="fas fa-clock"></i> Menunggu Approval
                            </a>
                            <a href="{{ route('pengembalian') }}" class="btn btn-success btn-sm">
                                <i class="fas fa-box"></i> Pengembalian
                            </a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
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
                                            <td class="text-center">{{ $peminjams->firstItem() + $i }}</td>
                                            <td>{{ $p->user->nama ?? '-' }}</td>
                                            <td>{{ $p->alat->nama_alat ?? '-' }}</td>
                                            <td>{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d M Y') }}</td>
                                            <td>
                                                @if($p->tgl_pengembalian)
                                                    @php $tgl = \Carbon\Carbon::parse($p->tgl_pengembalian)->startOfDay(); @endphp
                                                    @if($tgl->lt(\Carbon\Carbon::today()))
                                                        <span class="text-danger font-weight-bold">
                                                            {{ $tgl->format('d M Y') }}
                                                            <small class="badge badge-danger">Telat</small>
                                                        </span>
                                                    @else
                                                        {{ $tgl->format('d M Y') }}
                                                    @endif
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <span class="badge badge-primary">Dipinjam</span>
                                            </td>
                                            <td class="text-center">

                                                {{-- TANDAI KEMBALI --}}
                                                <form action="{{ route('peminjam.kembali', $p->id_peminjam) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    <button type="submit" class="btn btn-success btn-sm"
                                                        onclick="return confirm('Tandai alat ini sudah dikembalikan?')">
                                                        <i class="fas fa-undo"></i> Kembalikan
                                                    </button>
                                                </form>

                                                {{-- EDIT --}}
                                                <a href="{{ route('peminjam.edit', $p->id_peminjam) }}"
                                                    class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>

                                                {{-- HAPUS --}}
                                                <form action="{{ route('peminjam.destroy', $p->id_peminjam) }}" method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Hapus data ini?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>

                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">
                                                <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                                Tidak ada peminjaman aktif.
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