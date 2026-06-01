@extends('admin.layouts.app')

@section('content')
<div class="main-content">
<section class="section">

    <div class="section-header">
        <h1>Halaman Permohonan Peminjaman</h1>
    </div>

    <div class="section-body">
        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">
                    <i class="fas fa-clock text-warning mr-1"></i>
                    Menunggu Persetujuan
                </h4>
                <div>
                    <a href="{{ route('peminjam.aktif') }}" class="btn btn-info btn-sm mr-1">
                        <i class="fas fa-check-circle"></i> Peminjaman Aktif
                    </a>
                    <a href="{{ route('pengembalian') }}" class="btn btn-success btn-sm mr-1">
                        <i class="fas fa-box"></i> Pengembalian
                    </a>
                    <a href="{{ route('peminjam.create') }}" class="btn btn-primary btn-sm">
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
                                <th class="text-white">Batas Kembali</th>
                                <th class="text-white">Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($peminjams as $i => $p)
                            <tr>
                                <td class="text-center">{{ $peminjams->firstItem() + $i }}</td>
                                <td>{{ $p->user->nama ?? '-' }}</td>
                                <td>{{ $p->alat->nama_alat ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($p->tgl_pinjam)->format('d M Y') }}</td>
                                <td>{{ $p->tgl_pengembalian ? \Carbon\Carbon::parse($p->tgl_pengembalian)->format('d M Y') : '-' }}</td>
                                <td class="text-center">
                                    <span class="badge badge-warning">Menunggu</span>
                                </td>
                                <td class="text-center">

                                    {{-- APPROVE --}}
                                    <form action="{{ route('peminjam.approve', $p->id_peminjam) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm"
                                            onclick=" Swalfire.fire({
                                                title: 'Setujui peminjaman ini?',
                                                text: 'Pastikan data sudah benar sebelum menyetujui.',
                                                icon: 'question',
                                                showCancelButton: true,
                                                confirmButtonText: 'Ya, Setujui',
                                                cancelButtonText: 'Batal'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    this.form.submit();
                                                }
                                            }); return false;">
                                            <i class="fas fa-check"></i> Setujui
                                        </button>
                                    </form>

                                    {{-- TOLAK --}}
                                    <button type="button" class="btn btn-danger btn-sm"
                                        onclick="showTolakModal({{ $p->id_peminjam }})">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>

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
                                    <i class="fas fa-check-circle text-success fa-2x mb-2 d-block"></i>
                                    Tidak ada permohonan yang menunggu persetujuan.
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
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title"><i class="fas fa-times-circle mr-1"></i> Tolak Peminjaman</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <form id="formTolak" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold">Alasan Penolakan (opsional)</label>
                        <textarea name="catatan" class="form-control" rows="3"
                            placeholder="Contoh: Stok tidak mencukupi, alat sedang dalam perbaikan, dll."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-times"></i> Tolak
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('js')
<script>
function showTolakModal(id) {
    const form = document.getElementById('formTolak');
    form.action = '/admin/peminjaman/' + id + '/tolak';
    $('#modalTolak').modal('show');
}
</script>
@endpush
@endsection