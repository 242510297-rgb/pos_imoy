

<?php $__env->startSection('title', 'POS'); ?>

<?php $__env->startSection('content'); ?>


<?php if(session('errors')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?php echo e(session('errors')); ?>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<h4 class="mb-3 fw-bold">Point of Sale (POS)</h4>

<div class="row g-3">

    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <!-- Form Pencarian -->
                <form method="GET" action="<?php echo e(route('penjualan.create')); ?>">
                    <div class="input-group">
                        <input type="text"
                               name="search"
                               value="<?php echo e(request('search')); ?>"
                               class="form-control"
                               placeholder="Cari produk..."
                               onkeyup="this.form.submit()">
                        <button class="btn btn-outline-secondary" type="submit">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                </form>
            </div>

            <div class="card-body" style="max-height:70vh; overflow-y:auto">
                <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <form method="POST" action="<?php echo e(route('itempenjualan.store')); ?>" class="row g-2 mb-2 align-items-center">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                        <input type="hidden" name="penjualan_id" value="<?php echo e($sale->id); ?>">

                        <!-- Tombol Informasi Produk -->
                        <div class="col-7">
                            <div class="btn btn-outline-primary w-100 text-start p-2 d-flex align-items-center gap-2 disabled-link">
                                <?php if($product->foto): ?>
                                    <img src="<?php echo e(asset('storage/'.$product->foto)); ?>"
                                         alt="<?php echo e($product->nama); ?>"
                                         class="rounded-circle"
                                         style="width:45px; height:45px; object-fit:cover;">
                                <?php else: ?>
                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:45px; height:45px">
                                        <i class="bi bi-box-seam"></i>
                                    </div>
                                <?php endif; ?>

                                <div>
                                    <div class="fw-semibold text-truncate" style="max-width: 150px;"><?php echo e($product->nama); ?></div>
                                    <small class="text-muted">Rp <?php echo e(number_format($product->harga_jual, 0, ',', '.')); ?></small>
                                </div>
                            </div>
                        </div>

                        <!-- Input Kuantitas -->
                        <div class="col-3">
                            <input type="number" 
                                   name="quantity" 
                                   value="1" 
                                   min="1"
                                   max="<?php echo e($product->stok); ?>"
                                   class="form-control"
                                   <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>>
                        </div>

                        <!-- Tombol Tambah ke Keranjang -->
                        <div class="col-2">
                            <button class="btn btn-primary w-100 <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>" 
                                    type="submit" 
                                    title="Tambah">
                                +
                            </button>
                        </div>
                    </form>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center text-muted py-4">
                        Produk tidak ditemukan.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 fw-bold">
                Keranjang Belanja
            </div>
            
            <div class="table-responsive" style="max-height:50vh; overflow-y:auto">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th style="width: 20%">Qty</th>
                            <th>Subtotal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $sale->itemPenjualan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="fw-medium"><?php echo e($item->produk->nama); ?></td>
                                <td>Rp <?php echo e(number_format($item->produk->harga_jual, 0, ',', '.')); ?></td>
                                <td>
                                    <!-- Update Kuantitas Keranjang -->
                                    <form method="POST" action="<?php echo e(route('itempenjualan.update', $item->id)); ?>">
                                        <?php echo csrf_field(); ?> 
                                        <?php echo method_field('PUT'); ?>
                                        <input type="number" 
                                               name="quantity"
                                               value="<?php echo e($item->kuantitas); ?>"
                                               min="1"
                                               class="form-control form-control-sm"
                                               onchange="this.form.submit()"
                                               <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>>
                                    </form>
                                </td>
                                <td class="fw-semibold">Rp <?php echo e(number_format($item->subtotal, 0, ',', '.')); ?></td>
                                <td class="text-center">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $item)): ?>
                                        <form method="POST" action="<?php echo e(route('itempenjualan.destroy', $item->id)); ?>">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="btn btn-outline-danger btn-sm" <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>>
                                                Hapus
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Keranjang Masih Kosong
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Total & Checkout -->
            <div class="card-footer bg-white p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="fs-5 fw-bold">Total Pembayaran:</span>
                    <span class="fs-4 fw-bold text-success">Rp <?php echo e(number_format($sale->total_pembayaran ?? 0, 0, ',', '.')); ?></span>
                </div>

                <!-- Form Checkout -->
                <form method="POST" 
                      action="<?php echo e(route('penjualan.update', $sale->id)); ?>" 
                      onsubmit="return confirm('Yakin ingin menyelesaikan transaksi ini?')" 
                      class="mb-2">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    
                    <select name="payment_method" class="form-select mb-2" required <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>>
                        <option value="">-- Pilih Metode Pembayaran --</option>
                        <option value="CASH">Cash (Tunai)</option>
                        <option value="QRIS">QRIS</option>
                    </select>

                    <button class="btn btn-success w-100 py-2 fw-semibold <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">
                        Checkout / Selesaikan Transaksi
                    </button>
                </form>

                <!-- Form Batalkan Transaksi -->
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $sale)): ?>
                    <form action="<?php echo e(route('penjualan.destroy', $sale->id)); ?>"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin membatalkan seluruh transaksi ini?')">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button class="btn btn-outline-danger w-100 <?php echo e($sale->status === 'COMPLETED' ? 'disabled' : ''); ?>">
                            Batalkan Transaksi
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_imoy\resources\views/penjualan/pos.blade.php ENDPATH**/ ?>