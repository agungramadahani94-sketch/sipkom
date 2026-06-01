@extends('admin.layouts.app')

@section('content')
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Halaman Peminjaman</h1>
        </div>

        <div class="section-body">
            <div class="card shadow-sm">

                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">
                        <i class="fas fa-hourglass-half text-warning mr-1"></i>
                        Menunggu Persetujuan
                    </h4>
                    <div>
                        <a href="{{ route('peminjam.aktif') }}" class="btn btn-primary btn-sm mr-1">
                            <i class="fas fa-hand-holding"></i> Peminjaman Aktif
                        </a>
                        <a href="{{ route('peminjam.create') }}" class="btn btn-success btn-sm">
                            <i class="fas fa-plus"></i> Tambah Manual
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead class="text-center">
                                <tr class="bg-warning">
                                    <th class="text-white">No</th>
                                    <th class="text-white">Nama Peminjam</th>
                                    <th class="text-white">Alat</th>
                                    <th class="text-white">Tgl Pinjam</th>
                                    <th class="text-white">Tgl Kembali</th>
                                    <th class="text-white">Status</th>
                                    <th class="text-white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($peminjams as $i => $p)
                                <tr>
                                    <td class="text-center">{{ $peminjams->firstItem() + $i }}</td>
                                    <td>{{ $p->user->nama ?? '-' }}</td>
                                    <td>{{ $p->alat->nama_alat ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d M Y') }}</td>
                                    <td>{{ $p->tgl_pengembalian ? \Carbon\Carbon::parse($p->tgl_pengembalian)->format('d M Y') : '-' }}</td>
                                    <td class="text-center">
                                        <span class="badge badge-warning px-3 py-2">Menunggu</span>
                                    </td>
                                    <td class="text-center">

                                        {{-- APPROVE --}}
                                        <form action="{{ route('peminjam.approve', $p->id_peminjam) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm"
                                              Swal.fire({
                                                icon: 'success',
                                                title: 'Berhasil',
                                                text: 'Peminjaman disetujui',
                                                showConfirmButton: false,
                                                timer: 2000">
                                                <i class="fas fa-check"></i> Setujui
                                            </button>
                                        </form>

                                        {{-- TOLAK --}}
                                        <button type="button" class="btn btn-danger btn-sm"
                                            onclick="showTolakModal({{ $p->id_peminjam }})">
                                            <i class="fas fa-times"></i> Tolak
                                        </button>

                                        {{-- EDIT --}}
                                        <a href="{{ route('peminjam.edit', $p->id_peminjam) }}"
                                           class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        {{-- HAPUS --}}
                                        <form action="{{ route('peminjam.destroy', $p->id_peminjam) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-secondary btn-sm"
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
                                        Tidak ada permohonan yang menunggu.
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

{{-- MODAL TOLAK --}}
<div class="modal fade" id="modalTolak" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tolak Peminjaman</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <form id="formTolak" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label>Alasan Penolakan (opsional)</label>
                        <textarea name="catatan" class="form-control" rows="3"
                            placeholder="Masukkan alasan penolakan..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">Tolak</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showTolakModal(id) {
    const form = document.getElementById('formTolak');
    form.action = '/admin/peminjaman/' + id + '/tolak';
    $('#modalTolak').modal('show');
}
</script>

@endsection