@extends('user.layouts.app')

@section('content')
    <div class="main-content">
        <section class="section">

            {{-- HEADER --}}
            <div class="section-header justify-content-center flex-column">


                <div class="w-100" style="max-width: 600px;">
                    <div class="input-group">
                        <input id="alatSearch" type="text" class="form-control"
                            placeholder="Cari nama atau kategori alat..." aria-label="Cari alat">

                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button">
                                <i class="fas fa-search"></i>
                            </button>

                            <button id="clearSearch" class="btn btn-outline-danger" type="button">
                                Reset
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- CONTENT --}}
            <div class="section-body">
                <div class="row" id="alatList">

                    @forelse($alat as $item)
                        <div class="col-md-4 mb-4">

                            <div class="card alat-card h-100 shadow-sm border-0">

                                {{-- GAMBAR --}}
                                <div class="alat-img">
                                    @if($item->gambar && file_exists(public_path('storage/' . $item->gambar)))
                                        <img src="{{ asset('storage/' . $item->gambar) }}" alt="{{ $item->nama_alat }}"
                                            class="alat-img-content">
                                    @else
                                        <img src="{{ asset('images/no-image.png') }}" alt="No Image"
                                            class="alat-img-content img-empty">
                                    @endif
                                </div>

                                {{-- BODY --}}
                                <div class="card-body d-flex flex-column">

                                    <h5 class="alat-title">
                                        {{ $item->nama_alat }}
                                    </h5>

                                    <p class="alat-kategori">
                                        {{ ucfirst($item->kategori) }}
                                    </p>

                                    <div class="mb-3">
                                        <small class="text-muted d-block mb-1">
                                            Stok Tersedia:
                                        </small>

                                        <span class="badge badge-info">
                                            {{ $item->stok }} unit
                                        </span>

                                        <span class="badge badge-secondary ml-1">
                                            Kondisi: {{ ucfirst($item->kondisi) }}
                                        </span>
                                    </div>

                                    <div class="mt-auto">
                                        @if($item->stok > 0)
                                            <a href="{{ route('user.pinjam', $item->id_alat) }}" class="btn btn-primary btn-block">
                                                Pinjam ({{ $item->stok }} tersedia)
                                            </a>
                                        @else
                                            <button class="btn btn-secondary btn-block" disabled>
                                                Tidak tersedia
                                            </button>
                                        @endif
                                    </div>

                                </div>
                            </div>

                        </div>
                    @empty

                        <div class="col-12 text-center py-5">
                            <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada alat tersedia</p>
                        </div>

                    @endforelse

                    <div id="noResults" class="col-12 text-center py-5 d-none">
                        <i class="fas fa-search fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Tidak ada hasil pencarian.</p>
                    </div>

                </div>
            </div>

        </section>
    </div>

    <style>
        .alat-card {
            border-radius: 12px;
            overflow: hidden;
            transition: 0.25s ease;
        }

        .alat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, .12);
        }

        .alat-img {
            height: 200px;
            background: #f5f7fa;
            display: flex;
            align-items: center;
            justify-content: center;
            border-bottom: 1px solid #eee;
        }

        .alat-img-content {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            padding: 16px;
            transition: .3s;
        }

        .alat-card:hover .alat-img-content {
            transform: scale(1.05);
        }

        .img-empty {
            opacity: .4;
        }

        .alat-title {
            font-size: 16px;
            font-weight: 600;
            color: #007bff;
            margin-bottom: 4px;
        }

        .alat-kategori {
            font-size: 13px;
            color: #6c757d;
            margin-bottom: 10px;
        }

        .badge {
            padding: 5px 8px;
            font-size: 12px;
        }

        .section-header {
            justify-content: center !important;
            align-items: center !important;
            flex-direction: column !important;
            text-align: center !important;
        }

        .section-header h1 {
            width: 100%;
            text-align: center;
        }

        #alatSearch {
            min-height: 45px;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const searchInput = document.getElementById('alatSearch');
            const clearButton = document.getElementById('clearSearch');
            const noResults = document.getElementById('noResults');

            const alatRows = Array.from(
                document.querySelectorAll('#alatList > .col-md-4.mb-4')
            );

            function filterItems() {
                const searchTerm = searchInput.value.trim().toLowerCase();
                let visibleCount = 0;

                alatRows.forEach(function (row) {

                    const title =
                        row.querySelector('.alat-title')?.textContent.toLowerCase() || '';

                    const category =
                        row.querySelector('.alat-kategori')?.textContent.toLowerCase() || '';

                    const matches =
                        title.includes(searchTerm) ||
                        category.includes(searchTerm);

                    row.style.display = matches ? '' : 'none';

                    if (matches) {
                        visibleCount++;
                    }
                });

                if (searchTerm === '') {
                    noResults.classList.add('d-none');
                } else {
                    noResults.classList.toggle('d-none', visibleCount > 0);
                }
            }

            searchInput.addEventListener('input', filterItems);

            clearButton.addEventListener('click', function () {
                searchInput.value = '';
                filterItems();
                searchInput.focus();
            });

        });
    </script>
@endsection