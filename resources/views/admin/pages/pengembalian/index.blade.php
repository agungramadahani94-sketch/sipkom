@extends('admin.layouts.app')

@section('content')
<div class="main-content">
<section class="section">

    <div class="section-header">
        <h1>Halaman Data Pengembalian</h1>
    </div>

    <div class="section-body">
        <div class="card">

            <div class="card-header">
                <h4 class="mb-0">Riwayat Alat Dikembalikan</h4>
            </div>

            <div class="card-body">

                {{-- FILTER --}}
                <div class="row mb-3">
                    <div class="col-md-4">
                        <input type="text" id="filterNama" class="form-control" placeholder="Cari nama peminjam...">
                    </div>
                    <div class="col-md-3">
                        <input type="text" id="filterAlat" class="form-control" placeholder="Cari nama alat...">
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-bordered" id="table-pengembalian">

                        <thead class="text-center">
                            <tr class="bg-success">
                                <th class="text-white">No</th>
                                <th class="text-white">Nama Peminjam</th>
                                <th class="text-white">Alat</th>
                                <th class="text-white">Tanggal Pinjam</th>
                                <th class="text-white">Tanggal Dikembalikan</th>
                                <th class="text-white">Durasi</th>
                                <th class="text-white">Status</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($pengembalian as $i => $p)
                            <tr>
                                <td>{{ $pengembalian->firstItem() + $i }}</td>
                                <td>{{ $p->user->nama ?? '-' }}</td>
                                <td>{{ $p->alat->nama_alat ?? '-' }}</td>
                                <td>{{ $p->tgl_pinjam }}</td>
                                <td>{{ $p->tgl_pengembalian ?? '-' }}</td>
                                <td>
                                    @if($p->tgl_pinjam && $p->tgl_pengembalian)
                                        @php
                                            $durasi = \Carbon\Carbon::parse($p->tgl_pinjam)
                                                        ->diffInDays(\Carbon\Carbon::parse($p->tgl_pengembalian));
                                        @endphp
                                        {{ $durasi }} hari
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="badge badge-success">Dikembalikan</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center text-muted py-4">
                                    <i class="fas fa-inbox"></i>
                                    Belum ada data pengembalian.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

                {{-- PAGINATION --}}
                <div class="mt-3 d-flex justify-content-end">
                    {{ $pengembalian->links() }}
                </div>

            </div>
        </div>
    </div>

</section>
</div>

{{-- FILTER JS --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const filterNama = document.getElementById("filterNama");
    const filterAlat = document.getElementById("filterAlat");

    function doFilter() {
        const rows = document.querySelectorAll("#table-pengembalian tbody tr");
        const nama = filterNama.value.toLowerCase();
        const alat = filterAlat.value.toLowerCase();

        rows.forEach(row => {
            const colNama = (row.children[1]?.innerText || '').toLowerCase();
            const colAlat = (row.children[2]?.innerText || '').toLowerCase();

            if (colNama.includes(nama) && colAlat.includes(alat)) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    filterNama.addEventListener("keyup", doFilter);
    filterAlat.addEventListener("keyup", doFilter);
});
</script>

@endsection