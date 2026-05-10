@extends('user.layouts.app')

@section('content')
<h3>Dashboard</h3>
<p>Halo, {{ auth()->user()->nama }}</p>

<div class="alert alert-info">
    Selamat datang di sistem peminjaman alat 🔥
</div>
@endsection