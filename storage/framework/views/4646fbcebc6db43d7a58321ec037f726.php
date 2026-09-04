

<?php $__env->startSection('title', 'Produk'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container-fluid py-4">

<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

    <div>
        <h2 class="fw-bold mb-1">
            Produk
        </h2>

        <p class="text-muted mb-0">
            Kelola daftar produk, harga, stok, dan informasi produk.
        </p>
    </div>

    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Produk::class)): ?>
        <a href="<?php echo e(route('produk.create')); ?>" class="btn btn-primary px-4">
            <i class="bi bi-plus-lg me-1"></i>
            Tambah Produk
        </a>
    <?php endif; ?>

</div>



<div class="card border-0 shadow-sm mb-4">

    <div class="card-body p-3">

        <form action="<?php echo e(route('produk.index')); ?>" method="GET">

            <div class="row g-2">

                <div class="col-md-10">

                    <div class="input-group">

                        <span class="input-group-text bg-white">
                            <i class="bi bi-search text-muted"></i>
                        </span>

                        <input
                            type="text"
                            name="search"
                            value="<?php echo e(request()->search); ?>"
                            class="form-control border-start-0"
                            placeholder="Cari nama produk..."
                        >

                    </div>

                </div>

                <div class="col-md-2">

                    <button
                        class="btn btn-dark w-100"
                        type="submit">

                        <i class="bi bi-search me-1"></i>
                        Cari

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>



<div class="card border-0 shadow-sm">

    
    <div class="card-header bg-white border-0 p-4">

        <div class="d-flex justify-content-between align-items-center">

            <div>
                <h5 class="fw-bold mb-1">
                    Daftar Produk
                </h5>

                <small class="text-muted">
                    Menampilkan <?php echo e($products->total()); ?> produk
                </small>
            </div>

            <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2">
                <i class="bi bi-box-seam me-1"></i>
                Produk
            </span>

        </div>

    </div>


    
    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">

                    <tr>

                        <th class="ps-4" style="width: 60px;">
                            #
                        </th>

                        <th>
                            User
                        </th>

                        <th>
                            Foto
                        </th>

                        <th>
                            Nama Produk
                        </th>

                        <th>
                            Harga Beli
                        </th>

                        <th>
                            Harga Jual
                        </th>

                        <th class="text-center">
                            Stok
                        </th>

                        <th class="text-center pe-4">
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody>

                    <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                        <tr>

                            
                            <td class="ps-4 text-muted">
                                <?php echo e($products->firstItem() + $loop->index); ?>

                            </td>


                            
                            <td>

                                <div class="d-flex align-items-center">

                                    <div
                                        class="rounded-circle bg-primary bg-opacity-10
                                               text-primary d-flex align-items-center
                                               justify-content-center me-2"
                                        style="width: 36px; height: 36px;">

                                        <i class="bi bi-person"></i>

                                    </div>

                                    <span class="fw-semibold">
                                        <?php echo e($product->user->name ?? '-'); ?>

                                    </span>

                                </div>

                            </td>


                            
                            <td>

                                <?php if($product->foto): ?>

                                    <img
                                        src="<?php echo e(asset('storage/' . $product->foto)); ?>"
                                        alt="<?php echo e($product->nama); ?>"
                                        width="65"
                                        height="65"
                                        class="rounded-3 border"
                                        style="object-fit: cover;"
                                    >

                                <?php else: ?>

                                    <div
                                        class="bg-light border rounded-3
                                               d-flex align-items-center
                                               justify-content-center"
                                        style="width: 65px; height: 65px;">

                                        <i class="bi bi-image text-muted fs-4"></i>

                                    </div>

                                <?php endif; ?>

                            </td>


                            
                            <td>

                                <span class="fw-semibold">
                                    <?php echo e($product->nama); ?>

                                </span>

                            </td>


                            
                            <td>

                                <span class="text-muted">
                                    Rp <?php echo e(number_format($product->harga_beli, 0, ',', '.')); ?>

                                </span>

                            </td>


                            
                            <td>

                                <span class="fw-semibold text-success">
                                    Rp <?php echo e(number_format($product->harga_jual, 0, ',', '.')); ?>

                                </span>

                            </td>


                            
                            <td class="text-center">

                                <?php if($product->stok <= 0): ?>

                                    <span class="badge bg-danger px-3 py-2">
                                        <i class="bi bi-x-circle me-1"></i>
                                        Habis
                                    </span>

                                <?php elseif($product->stok <= 5): ?>

                                    <span class="badge bg-warning text-dark px-3 py-2">
                                        <i class="bi bi-exclamation-triangle me-1"></i>
                                        <?php echo e($product->stok); ?>

                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-success px-3 py-2">
                                        <?php echo e($product->stok); ?>

                                    </span>

                                <?php endif; ?>

                            </td>


                            
                            <td class="text-center pe-4">

                                <div class="d-flex justify-content-center gap-1">

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $product)): ?>

                                        <a
                                            href="<?php echo e(route('produk.edit', $product)); ?>"
                                            class="btn btn-outline-warning btn-sm"
                                            title="Edit produk">

                                            <i class="bi bi-pencil-square"></i>

                                        </a>

                                    <?php endif; ?>


                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $product)): ?>

                                        <form
                                            action="<?php echo e(route('produk.destroy', $product)); ?>"
                                            method="POST"
                                            class="d-inline">

                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>

                                            <button
                                                type="submit"
                                                class="btn btn-outline-danger btn-sm"
                                                title="Hapus produk"
                                                onclick="return confirm('Yakin hapus produk ini?')">

                                                <i class="bi bi-trash"></i>

                                            </button>

                                        </form>

                                    <?php endif; ?>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                        <tr>

                            <td
                                colspan="8"
                                class="text-center py-5">

                                <div class="text-muted">

                                    <i class="bi bi-box-seam fs-1 d-block mb-3"></i>

                                    <h6 class="fw-bold">
                                        Data tidak tersedia
                                    </h6>

                                    <p class="mb-0">
                                        Belum ada produk yang ditemukan.
                                    </p>

                                </div>

                            </td>

                        </tr>

                    <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>


    
    <?php if($products->hasPages()): ?>

        <div class="card-footer bg-white border-0 p-4">

            <div class="d-flex justify-content-center">
            </div>

        </div>

    <?php endif; ?>

</div>

</div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_imoy\resources\views/produk/index.blade.php ENDPATH**/ ?>