@extends('user.layouts.app')

@section('content')
<div class="main-content">
<section class="section">

    <div class="section-header">
        <h1>Halaman Riwayat Peminjaman</h1>
    </div>

    <div class="section-body">
        <div class="card shadow-sm">

            <div class="card-header">
                <h4>Daftar Peminjaman Saya</h4>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">

                        <thead>
                            <tr class="bg-primary">
                                <th class="text-white">No</th>
                                <th class="text-white">Alat</th>
                                <th class="text-white">Tgl Pinjam</th>
                                <th class="text-white">Batas Kembali</th>
                                <th class="text-white">Status</th>
                                <th class="text-white">Catatan Admin</th>
                                <th class="text-white">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($data as $i => $d)
                            <tr>
                                <td class="text-center">{{ $i + 1 }}</td>
                                <td>{{ $d->alat->nama_alat ?? '-' }}</td>
                                <td>{{ \Carbon\Carbon::parse($d->tgl_pinjam)->format('d M Y') }}</td>

                                <td>
                                    @if($d->tgl_pengembalian)
                                        {{ \Carbon\Carbon::parse($d->tgl_pengembalian)->format('d M Y') }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if($d->status === 'menunggu')
                                        <span class="badge badge-warning">Menunggu</span>
                                    @elseif($d->status === 'dipinjam')
                                        <span class="badge badge-primary">Dipinjam</span>
                                    @elseif($d->status === 'ditolak')
                                        <span class="badge badge-danger">Ditolak</span>
                                    @elseif($d->status === 'kembali')
                                        <span class="badge badge-success">Dikembalikan</span>
                                    @else
                                        <span class="badge badge-secondary">{{ ucfirst($d->status) }}</span>
                                    @endif
                                </td>

                                <td>
                                    @if($d->catatan_admin)
                                        {{ $d->catatan_admin }}
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                <td class="text-center">

                                    @if($d->status === 'dipinjam')
                                        <form action="{{ route('user.kembali', $d->id_peminjam) }}" method="POST">
                                            @csrf
                                            <button type="button"
                                                class="btn btn-success btn-sm"
                                                onclick="confirmKembali(this)">
                                                <i class="fas fa-undo"></i> Kembalikan
                                            </button>
                                        </form>

                                    @elseif($d->status === 'menunggu')
                                        <span class="text-warning small">Menunggu admin</span>

                                    @else
                                        <span class="text-muted">-</span>
                                    @endif

                                </td>

                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                                    Belum ada riwayat peminjaman.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>
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

{{-- CONFIRM RETURN --}}
<script>
function confirmKembali(btn) {
    Swal.fire({
        title: 'Kembalikan alat ini?',
        text: "Data akan diproses sebagai pengembalian",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#28a745',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Kembalikan',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            btn.closest('form').submit();
        }
    });
}
</script>

@endsection