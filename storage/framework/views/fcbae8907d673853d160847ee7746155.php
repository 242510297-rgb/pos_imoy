

<?php $__env->startSection('title', 'Tambah Jenis Barang'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            
            <!-- Breadcrumb / Tombol Kembali -->
            <div class="mb-3">
                <a href="<?php echo e(route('jenis.index')); ?>" class="text-decoration-none text-secondary small">
                    <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar Jenis
                </a>
            </div>

            <!-- Card Form Create -->
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-primary bg-opacity-10 border-0 rounded-top-4 p-4">
                    <div class="d-flex align-items-center">
                        <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 48px; height: 48px;">
                            <i class="bi bi-tags fs-4"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-0">Tambah Jenis Barang</h5>
                            <small class="text-muted">Masukkan informasi jenis barang baru</small>
                        </div>
                    </div>
                </div>

                <div class="card-body p-4">
                    <form action="<?php echo e(route('jenis.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>

                        <!-- Input Nama Jenis -->
                        <div class="mb-4">
                            <label for="nama_jenis" class="form-label fw-semibold text-dark">
                                Nama Jenis <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control rounded-3 <?php $__errorArgs = ['nama_jenis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="nama_jenis" 
                                   name="nama_jenis" 
                                   value="<?php echo e(old('nama_jenis')); ?>" 
                                   placeholder="Contoh: Makanan / Minuman / Pakaian" 
                                   required>
                            <?php $__errorArgs = ['nama_jenis'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-end gap-2">
                            <a href="<?php echo e(route('jenis.index')); ?>" class="btn btn-light rounded-3 px-4">
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary rounded-3 px-4">
                                <i class="bi bi-save me-1"></i> Simpan Data
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_imoy\resources\views/jenis/create.blade.php ENDPATH**/ ?>