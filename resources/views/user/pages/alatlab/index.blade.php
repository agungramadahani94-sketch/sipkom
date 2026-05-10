@extends('user.layouts.app')

@section('content')
<h3>Daftar Alat</h3>

<div class="row">
@foreach($alat as $item)
    <div class="col-md-4 mb-3">
        <div class="card p-3">

            <h5>{{ $item->nama_alat }}</h5>
            <p>Kategori: {{ $item->kategori }}</p>
            <p>Stok: <b>{{ $item->stok }}</b></p>

            {{-- BUTTON PINJAM --}}
            <form action="{{ route('user.pinjam') }}" method="POST">
                @csrf
                <input type="hidden" name="alat_id" value="{{ $item->id_alat }}">

                <button class="btn btn-primary w-100"
                    {{ $item->stok == 0 ? 'disabled' : '' }}>
                    {{ $item->stok == 0 ? 'Stok Habis' : 'Pinjam' }}
                </button>
            </form>

        </div>
    </div>
@endforeach
</div>

@endsection