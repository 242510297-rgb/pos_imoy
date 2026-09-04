

<?php $__env->startSection('title', 'Penjualan'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container-fluid py-4">

    
    <?php if(session('errors')): ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <?php echo e(session('errors')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i>
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php endif; ?>

    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold text-primary mb-1">
                <i class="bi bi-cart-check-fill me-2"></i>
                Halaman Penjualan
            </h2>
            <p class="text-muted mb-0">
                Kelola seluruh transaksi penjualan.
            </p>
        </div>

        <a href="<?php echo e(route('penjualan.create')); ?>" class="btn btn-primary shadow-sm px-4">
            <i class="bi bi-plus-circle me-1"></i>
            Transaksi Baru
        </a>
    </div>

    
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">
            <form action="<?php echo e(route('penjualan.index')); ?>" method="GET">
                <div class="input-group">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search text-muted"></i>
                    </span>
                    <input type="text"
                           name="search"
                           value="<?php echo e(request('search')); ?>"
                           class="form-control border-start-0"
                           placeholder="Cari transaksi berdasarkan ID..."
                           onkeyup="this.form.submit()">
                    <button class="btn btn-primary" type="submit">Cari</button>
                </div>
            </form>
        </div>
    </div>

    
    <div class="card border-0 shadow-sm">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>ID Transaksi</th>
                            <th>Kasir / User</th>
                            <th>Metode Pembayaran</th>
                            <th>Total Pembayaran</th>
                            <th>Status</th>
                            <th>Tanggal</th>
                            <th class="text-center pe-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $penjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="ps-4"><?php echo e($penjualan->firstItem() + $key); ?></td>
                                <td class="fw-bold text-primary">#<?php echo e($item->id); ?></td>
                                <td><?php echo e($item->user->name ?? '-'); ?></td>
                                <td>
                                    <span class="badge bg-secondary">
                                        <?php echo e($item->payment_method ?? 'Belum Dipilih'); ?>

                                    </span>
                                </td>
                                <td class="fw-semibold">
                                    Rp <?php echo e(number_format($item->total_pembayaran ?? 0, 0, ',', '.')); ?>

                                </td>
                                <td>
                                    <?php if($item->status === 'COMPLETED'): ?>
                                        <span class="badge bg-success">Selesai</span>
                                    <?php elseif($item->status === 'OPEN'): ?>
                                        <span class="badge bg-warning text-dark">Proses</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">Batal</span>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo e($item->created_at->format('d M Y, H:i')); ?></td>
                                <td class="text-center pe-4">
                                    <a href="<?php echo e(route('penjualan.show', $item->id)); ?>" class="btn btn-sm btn-outline-info me-1" title="Detail">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $item)): ?>
                                        <form action="<?php echo e(route('penjualan.destroy', $item->id)); ?>" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-outline-danger" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="text-center text-muted py-4">
                                    Belum ada data transaksi penjualan.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        
        <?php if($penjualan->hasPages()): ?>
            <div class="card-footer bg-white border-0 py-3">
            </div>
        <?php endif; ?>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_imoy\resources\views/penjualan/index.blade.php ENDPATH**/ ?>