

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container-fluid py-4">

<div class="mb-4">
    <h2 class="fw-bold mb-1">
        Ringkasan Hari Ini
    </h2>
    <p class="text-muted mb-0">
        <?php echo e($tanggalHariIni->translatedFormat('l, d F Y')); ?>

    </p>
</div>


<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('viewAny', App\Models\User::class)): ?>

<div class="d-flex align-items-center mb-3">
    <div>
        <h4 class="fw-bold mb-0">Today's Sales</h4>
        <small class="text-muted">
            Ringkasan penjualan hari ini
        </small>
    </div>
</div>

<div class="row g-4 mb-5">

    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <p class="text-muted mb-2">
                            Total Nilai Penjualan Hari Ini
                        </p>

                        <h3 class="fw-bold mb-0">
                            Rp <?php echo e(number_format($ringkasan['total_penjualan'], 0, ',', '.')); ?>

                        </h3>
                    </div>

                    <div class="bg-success bg-opacity-10 text-success rounded-3 p-3">
                        <i class="bi bi-cash-stack fs-3"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <p class="text-muted mb-2">
                            Jumlah Transaksi Hari Ini
                        </p>

                        <h3 class="fw-bold mb-0">
                            <?php echo e(number_format($ringkasan['total_transaksi'], 0, ',', '.')); ?>

                        </h3>
                    </div>

                    <div class="bg-primary bg-opacity-10 text-primary rounded-3 p-3">
                        <i class="bi bi-receipt fs-3"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>



<div class="d-flex align-items-center mb-3">
    <div>
        <h4 class="fw-bold mb-0">Cash & Payment Status</h4>
        <small class="text-muted">
            Ringkasan metode pembayaran
        </small>
    </div>
</div>

<div class="row g-4 mb-5">

    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <p class="text-muted mb-2">
                            Total Pembayaran Tunai
                        </p>

                        <h3 class="fw-bold mb-0">
                            Rp <?php echo e(number_format($ringkasan['total_cash'], 0, ',', '.')); ?>

                        </h3>
                    </div>

                    <div class="bg-warning bg-opacity-10 text-warning rounded-3 p-3">
                        <i class="bi bi-wallet2 fs-3"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm h-100">
            <div class="card-body p-4">

                <div class="d-flex justify-content-between align-items-start">

                    <div>
                        <p class="text-muted mb-2">
                            Total Pembayaran Non-Tunai
                        </p>

                        <h3 class="fw-bold mb-0">
                            Rp <?php echo e(number_format($ringkasan['total_non_tunai'], 0, ',', '.')); ?>

                        </h3>
                    </div>

                    <div class="bg-info bg-opacity-10 text-info rounded-3 p-3">
                        <i class="bi bi-credit-card fs-3"></i>
                    </div>

                </div>

            </div>
        </div>
    </div>

</div>

<?php endif; ?>




<div class="d-flex align-items-center mb-3">
    <div>
        <h4 class="fw-bold mb-0">
            Critical Inventory Status
        </h4>

        <small class="text-muted">
            Pantau produk yang membutuhkan perhatian
        </small>
    </div>
</div>

<div class="row g-4 mb-5">

    
    <div class="col-lg-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white border-0 p-4 pb-2">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="fw-bold mb-1">
                            Produk Stok Rendah
                        </h5>

                        <small class="text-muted">
                            Produk yang perlu segera diperhatikan
                        </small>
                    </div>

                    <span class="badge bg-warning text-dark px-3 py-2">
                        <i class="bi bi-exclamation-triangle me-1"></i>
                        Stok Rendah
                    </span>

                </div>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Nama Produk</th>
                                <th class="text-center pe-4">Stok</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php $__empty_1 = true; $__currentLoopData = $produkStokRendah; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                <tr>
                                    <td class="ps-4 text-muted">
                                        <?php echo e($produkStokRendah->firstItem() + $index); ?>

                                    </td>

                                    <td class="fw-semibold">
                                        <?php echo e($produk->nama); ?>

                                    </td>

                                    <td class="text-center pe-4">
                                        <span class="badge bg-warning text-dark">
                                            <?php echo e($produk->stok); ?>

                                        </span>
                                    </td>
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        <i class="bi bi-check-circle text-success fs-4 d-block mb-2"></i>
                                        Seluruh produk berada dalam kondisi stok aman.
                                    </td>
                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

            <?php if($produkStokRendah->hasPages()): ?>
                <div class="card-footer bg-white border-0 px-4 pb-4">
                    <?php echo e($produkStokRendah->links()); ?>

                </div>
            <?php endif; ?>

        </div>

    </div>


    
    <div class="col-lg-6">

        <div class="card border-0 shadow-sm h-100">

            <div class="card-header bg-white border-0 p-4 pb-2">

                <div class="d-flex justify-content-between align-items-center">

                    <div>
                        <h5 class="fw-bold mb-1">
                            Produk Habis Stok
                        </h5>

                        <small class="text-muted">
                            Produk yang perlu segera direstock
                        </small>
                    </div>

                    <span class="badge bg-danger px-3 py-2">
                        <i class="bi bi-x-circle me-1"></i>
                        Habis
                    </span>

                </div>

            </div>

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th class="ps-4">#</th>
                                <th>Nama Produk</th>
                                <th class="text-center pe-4">Stok</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php $__empty_1 = true; $__currentLoopData = $produkStokHabis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                                <tr>
                                    <td class="ps-4 text-muted">
                                        <?php echo e($produkStokHabis->firstItem() + $index); ?>

                                    </td>

                                    <td class="fw-semibold">
                                        <?php echo e($produk->nama); ?>

                                    </td>

                                    <td class="text-center pe-4">
                                        <span class="badge bg-danger">
                                            <?php echo e($produk->stok); ?>

                                        </span>
                                    </td>
                                </tr>

                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        <i class="bi bi-check-circle text-success fs-4 d-block mb-2"></i>
                                        Tidak ada produk yang habis stok.
                                    </td>
                                </tr>

                            <?php endif; ?>

                        </tbody>

                    </table>

                </div>

            </div>

            <?php if($produkStokHabis->hasPages()): ?>
                <div class="card-footer bg-white border-0 px-4 pb-4">
                    <?php echo e($produkStokHabis->links()); ?>

                </div>
            <?php endif; ?>

        </div>

    </div>

</div>




<div class="d-flex justify-content-between align-items-center mb-3">

    <div>
        <h4 class="fw-bold mb-0">
            Best Seller Products
        </h4>

        <small class="text-muted">
            Produk dengan penjualan terbanyak
        </small>
    </div>

    <span class="badge bg-primary px-3 py-2">
        <i class="bi bi-trophy me-1"></i>
        Top Products
    </span>

</div>


<div class="card border-0 shadow-sm">

    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-dark">
                    <tr>
                        <th class="ps-4">Nama Produk</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center pe-4">Unit Terjual</th>
                    </tr>
                </thead>

                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $produkTerlaris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>

                            <td class="ps-4">
                                <div class="d-flex align-items-center">

                                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle p-2 me-3">
                                        <i class="bi bi-box-seam"></i>
                                    </div>

                                    <span class="fw-semibold">
                                        <?php echo e($produk->nama); ?>

                                    </span>

                                </div>
                            </td>

                            <td class="text-center">

                                <?php if($produk->stok <= 0): ?>

                                    <span class="badge bg-danger">
                                        Habis
                                    </span>

                                <?php elseif($produk->stok <= 5): ?>

                                    <span class="badge bg-warning text-dark">
                                        <?php echo e($produk->stok); ?>

                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-success">
                                        <?php echo e($produk->stok); ?>

                                    </span>

                                <?php endif; ?>

                            </td>

                            <td class="text-center pe-4">

                                <span class="fw-bold text-primary">
                                    <?php echo e(number_format($produk->total_terjual, 0, ',', '.')); ?>

                                </span>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>

                            <td colspan="3" class="text-center py-5 text-muted">

                                <i class="bi bi-bar-chart fs-1 d-block mb-2"></i>

                                Belum ada data produk terlaris.

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>

</div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_imoy\resources\views/dashboard.blade.php ENDPATH**/ ?>