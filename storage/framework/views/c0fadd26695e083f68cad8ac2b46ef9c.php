<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">POS</a>

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
                    <a class="nav-link <?php echo e(Request::routeIs('dashboard') ? 'active' : ''); ?>"
                        href="<?php echo e(route('dashboard')); ?>">
                        Dashboard
                    </a>
                </li>

                
                <?php if(in_array(auth()->user()->role?->name ?? auth()->user()->role, ['admin', 'kasir'])): ?>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('admin.users.*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('users.index')); ?>">
                        Users
                    </a>
                </li>
                <?php endif; ?>

                
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('jenis.*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('jenis.index')); ?>">
                        Jenis 
                    </a>
                </li>

                
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('produk.*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('produk.index')); ?>">
                        Produk
                    </a>
                </li>

                
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('penjualan.*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('penjualan.index')); ?>">
                        Penjualan
                    </a>
                </li>

                
                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('tentang.*') ? 'active' : ''); ?>"
                        href="<?php echo e(route('tentang.index')); ?>">
                        Tentang
                    </a>
                </li>

            </ul>

            <!-- Bagian Kanan Navbar: Nama User, Role (Admin/Kasir), & Tombol Logout -->
            <div class="d-flex align-items-center gap-3">
                <?php if(auth()->guard()->check()): ?>
                    <?php
                        $userRole = auth()->user()->role?->name ?? auth()->user()->role;
                    ?>
                    <div class="d-flex align-items-center gap-2">
                        <i class="bi bi-person-circle text-primary fs-5"></i>
                        <div class="d-flex flex-column text-end lh-sm">
                            <span class="text-dark fw-semibold small"><?php echo e(Auth::user()->name); ?></span>
                            <span class="text-muted" style="font-size: 0.75rem;">
                                <?php echo e(ucfirst($userRole ?? 'User')); ?>

                            </span>
                        </div>
                    </div>
                <?php endif; ?>

                <form action="<?php echo e(route('logout')); ?>" method="POST" class="d-inline mb-0">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn btn-danger btn-sm">
                        Logout
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav><?php /**PATH C:\laragon\www\pos_imoy\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>