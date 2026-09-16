<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('tentang.index') }}">IkriShoes</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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

                {{-- Menu Users hanya untuk admin --}}
                @if((auth()->user()->role?->name ?? auth()->user()->role) === 'admin')
                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('users.*') ? 'active' : '' }}"
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

            <!-- Tombol Logout -->
            <div class="d-flex align-items-center gap-3">
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