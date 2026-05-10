@extends('user.layouts.app')

@section('content')
<h3>Riwayat Peminjaman</h3>

<table class="table table-bordered">
    <tr>
        <th>No</th>
        <th>Alat</th>
        <th>Tanggal Pinjam</th>
        <th>Status</th>
        <th>Aksi</th>
    </tr>

@foreach($data as $i => $d)
<tr>
    <td>{{ $i+1 }}</td>
    <td>{{ $d->alat->nama_alat ?? '-' }}</td>
    <td>{{ $d->tanggal_pinjam }}</td>

    {{-- STATUS --}}
    <td>
        @if($d->status == 'dipinjam')
            <span class="badge bg-danger">Dipinjam</span>
        @else
            <span class="badge bg-success">Dikembalikan</span>
        @endif
    </td>

    {{-- AKSI --}}
    <td>
        @if($d->status == 'dipinjam')
        <form action="{{ route('user.kembali', $d->id) }}" method="POST">
            @csrf
            <button class="btn btn-success btn-sm">Kembalikan</button>
        </form>
        @else
            <span>-</span>
        @endif
    </td>
</tr>
@endforeach

</table>

@endsection