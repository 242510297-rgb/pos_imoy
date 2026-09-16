

<?php $__env->startSection('title', 'Struk Pembayaran'); ?>

<?php $__env->startSection('content'); ?>

    <?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="container-fluid py-4">
        <div class="receipt mx-auto" style="max-width: 620px;">
            <div class="d-flex justify-content-between align-items-start mb-4 receipt-actions">
                <a href="<?php echo e(route('penjualan.index')); ?>" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Kembali
                </a>
                <button type="button" class="btn btn-primary" onclick="window.print()">
                    <i class="bi bi-printer me-1"></i> Cetak Struk
                </button>
            </div>

            <?php if(session('success')): ?>
                <div class="alert alert-success receipt-actions">
                    <i class="bi bi-check-circle-fill me-2"></i><?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="card border-0 shadow-sm">
                <div class="card-body p-4 p-md-5">
                    <div class="text-center border-bottom pb-3 mb-3">
                        <h3 class="fw-bold mb-1">IkriShoes</h3>
                        <p class="text-muted mb-2">Struk Pembayaran</p>
                        <span class="badge bg-success">LUNAS</span>
                    </div>

                    <div class="row g-2 small mb-4">
                        <div class="col-6">
                            <span class="text-muted d-block">No. Transaksi</span>
                            <strong>#<?php echo e($penjualan->id); ?></strong>
                        </div>
                        <div class="col-6 text-end">
                            <span class="text-muted d-block">Tanggal</span>
                            <strong><?php echo e($penjualan->updated_at->format('d/m/Y H:i')); ?></strong>
                        </div>
                        <div class="col-6">
                            <span class="text-muted d-block">Kasir</span>
                            <strong><?php echo e($penjualan->user->name ?? '-'); ?></strong>
                        </div>
                        <div class="col-6 text-end">
                            <span class="text-muted d-block">Pembayaran</span>
                            <strong><?php echo e($penjualan->metode_pembayaran); ?></strong>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table align-middle mb-3">
                            <thead class="table-light">
                                <tr>
                                    <th>Produk</th>
                                    <th class="text-center">Qty</th>
                                    <th class="text-end">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $penjualan->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td>
                                            <div class="fw-semibold"><?php echo e($item->produk->nama ?? '-'); ?></div>
                                            <small class="text-muted">Rp
                                                <?php echo e(number_format($item->harga_satuan, 0, ',', '.')); ?></small>
                                        </td>
                                        <td class="text-center"><?php echo e($item->kuantitas); ?></td>
                                        <td class="text-end">Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="border-top pt-3 d-flex justify-content-between fs-5 fw-bold">
                        <span>Total</span>
                        <span>Rp <?php echo e(number_format($penjualan->total_pembayaran, 0, ',', '.')); ?></span>
                    </div>

                    <div class="small mt-3">
                        <div class="d-flex justify-content-between">
                            <span>Uang dibayar</span>
                            <span>Rp
                                <?php echo e(number_format($penjualan->uang_dibayar ?? $penjualan->total_pembayaran, 0, ',', '.')); ?></span>
                        </div>
                        <div class="d-flex justify-content-between fw-bold text-success">
                            <span>Kembalian</span>
                            <span>Rp <?php echo e(number_format($penjualan->kembalian ?? 0, 0, ',', '.')); ?></span>
                        </div>
                    </div>

                    <p class="text-center text-muted small mt-4 mb-0">Terima kasih atas pembelian Anda.</p>
                </div>
            </div>
        </div>
    </div>

    <style>
        @media print {
            body {
                background: #fff !important;
            }

            .navbar,
            .receipt-actions {
                display: none !important;
            }

            .container-fluid {
                padding: 0 !important;
            }

            .receipt {
                max-width: 100% !important;
            }

            .card {
                box-shadow: none !important;
            }
        }
    </style>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_imoy\resources\views/penjualan/show.blade.php ENDPATH**/ ?>