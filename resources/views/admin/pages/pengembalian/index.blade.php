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
                <h4>Data Pengembalian</h4>
            </div>

            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered">

                        <thead class="text-center">
                            <tr class="bg-primary ">
                                <th class="text-white">No</th>
                                <th class="text-white">Nama</th>
                                <th class="text-white">Alat</th>
                                <th class="text-white">Tgl Pinjam</th>
                                <th class="text-white">Batas Kembali</th>
                                <th class="text-white">Status</th>
                             
                            </tr>
                        </thead>

                        <tbody>
                            @forelse ($peminjams as $i => $p)
                            <tr>
                                <td>{{ $peminjams->firstItem() + $i }}</td>
                                <td>{{ $p->user->nama ?? '-' }}</td>
                                <td>{{ $p->alat->nama_alat ?? '-' }}</td>
                                <td>{{ $p->tgl_pinjam }}</td>
                                <td>{{ $p->tgl_pengembalian }}</td>

                                {{-- 🔥 STATUS TELAT --}}
                                <td>
                                    @if(now()->gt($p->tgl_pengembalian))
                                        <span class="badge badge-danger">Telat</span>
                                    @else
                                        <span class="badge badge-warning">Dipinjam</span>
                                    @endif
                                </td>

                                <td>
                                    <form action="{{ route('peminjam.kembali', $p->id_peminjam) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success btn-sm">
                                            Kembalikan
                                        </button>
                                    </form>
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
@endsection