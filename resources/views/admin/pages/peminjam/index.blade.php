@extends('admin.layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">

            <div class="section-header justify-content-center">
                <h1>Data Peminjaman</h1>
            </div>

            <div class="section-body">
                <div class="card">

                    <div class="card-header d-flex justify-content-between">
                        <h4>List Peminjaman</h4>
                        <a href="{{ route('peminjam.create') }}" class="btn btn-primary">+ Tambah</a>
                    </div>

                    <div class="card-body">

                        {{-- FILTER --}}
                        <div class="row mb-3">
                            <div class="col-md-3">
                                <select id="filterStatus" class="form-control">
                                    <option value="">Semua Status</option>
                                    <option value="dipinjam">Dipinjam</option>
                                    <option value="kembali">Dikembalikan</option>
                                </select>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered" id="table-peminjaman">

                                <thead class="text-center">
                                    <tr class="bg-primary">
                                        <th class="text-white">No</th>
                                        <th class="text-white">Nama Peminjam</th>
                                        <th class="text-white">Alat</th>
                                        <th class="text-white">Tanggal Pinjam</th>
                                        <th class="text-white">Tanggal Pengembalian</th>
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
                                                @if($p->status == 'dipinjam')
                                                    <span class="badge badge-warning">Dipinjam</span>
                                                @elseif($p->status == 'kembali')
                                                    <span class="badge badge-success">Kembali</span>
                                                @else
                                                    <span class="badge badge-secondary">-</span>
                                                @endif
                                            </td>

                                            <td>
                                                @if($p->status == 'dipinjam')
                                                    <form action="{{ route('peminjam.kembali', $p->id_peminjam) }}" method="POST" style="display:inline;">
                                                        @csrf
                                                        <button class="btn btn-success btn-sm">Tandai Kembali</button>
                                                    </form>
                                                @else
                                                    <span class="text-muted">Selesai</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada data</td>
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

    {{-- FILTER JS --}}
    <script>
        document.getElementById("filterStatus").addEventListener("change", function () {
            let value = this.value.toLowerCase();
            let rows = document.querySelectorAll("#table-peminjaman tbody tr");

            rows.forEach(row => {
                let status = row.children[5]?.innerText.toLowerCase() ?? '';

                if (value === "" || status.includes(value)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        });
    </script>

@endsection