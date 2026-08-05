<?php $__env->startSection('title', 'Produk'); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<h1>Halaman Produk</h1>

<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create', App\Models\Produk::class)): ?>
<a href="<?php echo e(route('produk.create')); ?>" class="btn btn-primary mb-3">
    Tambah Produk
</a>
<?php endif; ?>

<form action="<?php echo e(route('produk.index')); ?>" method="GET" class="mb-3">
    <div class="input-group">
        <input
            type="text"
            name="search"
            value="<?php echo e(request()->search); ?>"
            class="form-control"
            placeholder="Search nama produk">

        <button class="btn btn-outline-secondary" type="submit">
            Search
        </button>
    </div>
</form>

<table class="table table-bordered">

    <thead>
        <tr>
            <th>#</th>
            <th>User</th>
            <th>Foto</th>
            <th>Nama</th>
            <th>Harga Beli</th>
            <th>Harga Jual</th>
            <th>Stok</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

        <tr>
            <td><?php echo e($products->firstItem() + $loop->index); ?></td>

            <td>
                <?php echo e($product->user->name ?? '-'); ?>

            </td>

            <td>
                <?php if($product->foto): ?>
                    <img src="<?php echo e(asset('storage/' . $product->foto)); ?>"
                         width="100"
                         class="img-thumbnail">
                <?php else: ?>
                    Tidak ada foto
                <?php endif; ?>
            </td>

            <td><?php echo e($product->nama); ?></td>

            <td>
                Rp <?php echo e(number_format($product->harga_beli)); ?>

            </td>

            <td>
                Rp <?php echo e(number_format($product->harga_jual)); ?>

            </td>

            <td>
                <?php echo e($product->stok); ?>

            </td>

            <td>

                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('update', $product)): ?>
                <a href="<?php echo e(route('produk.edit', $product)); ?>"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>
                <?php endif; ?>


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete', $product)): ?>

                <form action="<?php echo e(route('produk.destroy', $product)); ?>"
                      method="POST"
                      class="d-inline">

                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>

                    <button class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin hapus produk ini?')">
                        Hapus
                    </button>

                </form>

                <?php endif; ?>

            </td>

        </tr>


        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

        <tr>
            <td colspan="8" class="text-center">
                Data tidak tersedia.
            </td>
        </tr>

        <?php endif; ?>

    </tbody>

</table>


<?php echo e($products->links()); ?>


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_imoy\resources\views/produk/index.blade.php ENDPATH**/ ?>