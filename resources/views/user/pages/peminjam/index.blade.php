@extends('user.layouts.app')

@section('content')
<div class="main-content">
    <section class="section">

        <div class="section-header">
            <h1>Riwayat Peminjaman</h1>
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
                                    <th class="text-white">Tanggal Pinjam</th>
                                    <th class="text-white">Tanggal Kembali</th>
                                    <th class="text-white">Status</th>
                                    <th class="text-white">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($data as $i => $d)
                                <tr>
                                    <td>{{ $i + 1 }}</td>
                                    <td>{{ $d->alat->nama_alat ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($d->tgl_pinjam)->format('d M Y') }}</td>

                                    {{-- TANGGAL KEMBALI --}}
                                    <td>
                                        @if($d->tgl_pengembalian)
                                            @php
                                                $tglKembali = \Carbon\Carbon::parse($d->tgl_pengembalian)->startOfDay();
                                                $today      = \Carbon\Carbon::today();
                                                $isTelat    = $d->status === 'dipinjam' && $tglKembali->lt($today);
                                            @endphp

                                            @if($isTelat)
                                                <span class="text-danger font-weight-bold">
                                                    {{ $tglKembali->format('d M Y') }}
                                                    <small>(Telat)</small>
                                                </span>
                                            @else
                                                {{ $tglKembali->format('d M Y') }}
                                            @endif
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>

                                    {{-- STATUS --}}
                                    <td>
                                        @if($d->status == 'dipinjam')
                                            <span class="badge badge-warning">Dipinjam</span>
                                        @else
                                            <span class="badge badge-success">Dikembalikan</span>
                                        @endif
                                    </td>

                                    {{-- AKSI --}}
                                    <td>
                                        @if($d->status == 'dipinjam')
                                            <form action="{{ route('user.kembali', $d->id_peminjam) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm"
                                                    onclick="return confirm('Kembalikan alat ini?')">
                                                    <i class="fas fa-undo"></i> Kembalikan
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">
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