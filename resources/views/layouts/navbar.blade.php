<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">POS</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent"
            aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}"
                        href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>

                {{-- Menampilkan menu Users untuk admin dan kasir --}}
                @if(in_array(auth()->user()->role?->name ?? auth()->user()->role, ['admin', 'kasir']))
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('admin.users.*') ? 'active' : '' }}"
                        href="{{ route('users.index') }}">
                        Users
                    </a>
                </li>
                @endif

                {{-- Menu Jenis --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('jenis.*') ? 'active' : '' }}"
                        href="{{ route('jenis.index') }}">
                        Jenis 
                    </a>
                </li>

                {{-- Menu Produk --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('produk.*') ? 'active' : '' }}"
                        href="{{ route('produk.index') }}">
                        Produk
                    </a>
                </li>

                {{-- Menu Penjualan --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('penjualan.*') ? 'active' : '' }}"
                        href="{{ route('penjualan.index') }}">
                        Penjualan
                    </a>
                </li>

                {{-- Menu Tentang --}}
                <li class="nav-item">
                    <a class="nav-link {{ Request::routeIs('tentang.*') ? 'active' : '' }}"
                        href="{{ route('tentang.index') }}">
                        Tentang
                    </a>
                </li>

            </ul>

            <!-- Bagian Kanan Navbar: Nama User, Role (Admin/Kasir), & Tombol Logout -->
            <div class="d-flex align-items-center gap-3">
                @auth
                    @php
                        $userRole = auth()->user()->role?->name ?? auth()->user()->role;
                    @endphp
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-person-circle text-primary fs-5"></i>
                        <div class="d-flex flex-column text-end lh-sm">
                            <span class="text-dark fw-semibold small">{{ Auth::user()->name }}</span>
                            <span class="text-muted" style="font-size: 0.75rem;">
                                {{ ucfirst($userRole ?? 'User') }}
                            </span>
                        </div>
                    </div>
                @endauth

                <form action="{{ route('logout') }}" method="POST" class="d-inline mb-0">
                    @csrf
                    <button type="submit" class="btn btn-danger btn-sm">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>