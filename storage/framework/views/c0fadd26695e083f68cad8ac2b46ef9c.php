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

                <?php if(auth()->user()->role == 'admin'): ?>

                <li class="nav-item">
                    <a class="nav-link <?php echo e(Request::routeIs('admin.users.*') ? 'active' : ''); ?>"
                       href="<?php echo e(route('admin.users.index')); ?>">
                        Users
                    </a>
                </li>

                <?php endif; ?>


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

            </ul>


            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger">
                    Logout
                </button>
            </form>

        </div>
    </div>
</nav><?php /**PATH C:\laragon\www\pos_imoy\resources\views/layouts/navbar.blade.php ENDPATH**/ ?>