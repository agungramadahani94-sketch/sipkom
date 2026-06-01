@extends('admin.layouts.app')

@section('content')
<div class="main-content">
    <section class="section">
        
        {{-- HEADER --}}
        <div class="section-header">
            <h1>Halaman Data User</h1>
        </div>

        <div class="section-body">
            <div class="card shadow-sm">
                
                <div class="card-header">
                    <h4><i class="fas fa-user"></i> Data User</h4>
                </div>

                <div class="card-body">

                    {{-- FILTER --}}
                    <div class="row mb-3">
                        <div class="col-md-3">
                            <input type="text" id="filterNama" class="form-control" placeholder="Cari Nama">
                        </div>
                        <div class="col-md-3">
                            <input type="text" id="filterEmail" class="form-control" placeholder="Cari Email">
                        </div>
                        <div class="col-md-3">
                            <select id="filterRole" class="form-control">
                                <option value="">Semua Role</option>
                                <option value="admin">Admin</option>
                                <option value="user">User</option>

                            </select>
                        </div>
                    </div>

                    {{-- TABLE --}}
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered" id="table-user">
                            
                            <thead>
                                <tr class="text-center bg-primary shadow-sm">
                                    <th class="text-white">No</th>
                                    <th class="text-white">Nama</th>
                                    <th class="text-white">Email</th>
                                    <th class="text-white">Role</th>         
                                </tr>
                            </thead>

                            <tbody class="text">
                                @forelse ($users as $index => $user)
                                <tr>
                                    <td class="text-center">{{ $index + 1 }}</td>
                                    <td>{{ $user->nama }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span class="badge {{ $user->role == 'admin' ? 'badge-primary' : 'badge-success' }}">
                                            {{ $user->role }}
                                        </span>
                                    </td>
                                  
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Data tidak ada</td>
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

{{-- FILTER JS --}}
<script>
document.addEventListener("DOMContentLoaded", function () {
    const nama = document.getElementById("filterNama");
    const email = document.getElementById("filterEmail");
    const role = document.getElementById("filterRole");

    function filterTable() {
        let rows = document.querySelectorAll("#table-user tbody tr");

        rows.forEach(row => {
            let colNama = row.children[1].innerText.toLowerCase();
            let colEmail = row.children[2].innerText.toLowerCase();
            let colRole = row.children[3].innerText.toLowerCase();

            let valNama = nama.value.toLowerCase();
            let valEmail = email.value.toLowerCase();
            let valRole = role.value.toLowerCase();

            if (
                colNama.includes(valNama) &&
                colEmail.includes(valEmail) &&
                (valRole === "" || colRole.includes(valRole))
            ) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    }

    nama.addEventListener("keyup", filterTable);
    email.addEventListener("keyup", filterTable);
    role.addEventListener("change", filterTable);
});
</script>

@endsection