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

                                {{-- TANGGAL KEMBALI --}}
                                <td>
                                    @if($d->tgl_pengembalian)
                                        @php
                                            $tglKembali = \Carbon\Carbon::parse($d->tgl_pengembalian)->startOfDay();
                                            $isTelat = $d->status === 'dipinjam' && $tglKembali->lt(\Carbon\Carbon::today());
                                        @endphp
                                        @if($isTelat)
                                            <span class="text-danger font-weight-bold">
                                                {{ $tglKembali->format('d M Y') }}
                                                <small class="badge badge-danger">Telat</small>
                                            </span>
                                        @else
                                            {{ $tglKembali->format('d M Y') }}
                                        @endif
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </td>

                                {{-- STATUS --}}
                                <td class="text-center">
                                    @if($d->status === 'menunggu')
                                        <span class="badge badge-warning">
                                            <i class="fas fa-clock"></i> Menunggu Approval
                                        </span>
                                    @elseif($d->status === 'dipinjam')
                                        <span class="badge badge-primary">
                                            <i class="fas fa-hand-holding"></i> Dipinjam
                                        </span>
                                    @elseif($d->status === 'ditolak')
                                        <span class="badge badge-danger">
                                            <i class="fas fa-times-circle"></i> Ditolak
                                        </span>
                                    @else
                                        <span class="badge badge-success">
                                            <i class="fas fa-check-circle"></i> Dikembalikan
                                        </span>
                                    @endif
                                </td>

                                {{-- CATATAN ADMIN --}}
                                <td>
                                    @if($d->catatan_admin)
                                        <small class="text-muted">{{ $d->catatan_admin }}</small>
                                    @else
                                        <small class="text-muted">-</small>
                                    @endif
                                </td>

                                {{-- AKSI --}}
                                <td class="text-center">
                                    @if($d->status === 'dipinjam')
                                        <form action="{{ route('user.kembali', $d->id_peminjam) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm"
                                                onclick="return confirm('Kembalikan alat ini?')">
                                                <i class="fas fa-undo"></i> Kembalikan
                                            </button>
                                        </form>
                                    @elseif($d->status === 'menunggu')
                                        <span class="text-warning small">
                                            <i class="fas fa-hourglass-half"></i> Menunggu admin
                                        </span>
                                    @else
                                        <span class="text-muted small">-</span>
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
@endsection