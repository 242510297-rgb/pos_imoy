

<?php $__env->startSection('title', 'Tentang Aplikasi'); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('layouts.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container py-4">
    <!-- Hero Banner Card -->
    <div class="card border-0 shadow-sm rounded-4 text-white overflow-hidden mb-5 position-relative" 
         style="background: linear-gradient(135deg, rgba(13, 110, 253, 0.85), rgba(33, 37, 41, 0.85)), url('https://images.unsplash.com/photo-1542291026-7eec264c27ff?auto=format&fit=crop&w=1200&q=80') center/cover no-repeat; min-height: 240px;">
        <div class="card-body p-4 p-md-5 d-flex flex-column justify-content-center text-center text-md-start">
            <span class="badge bg-white text-primary rounded-pill px-3 py-2 fw-bold mb-3 align-self-center align-self-md-start shadow-sm">
                Sistem Informasi Point of Sales
            </span>
            <h1 class="fw-bold display-5 mb-2">Tentang Aplikasi POS</h1>
            <p class="fs-6 opacity-90 col-lg-8 mb-0">
                Sistem Point of Sales (POS) terintegrasi untuk mempermudah manajemen toko, inventaris barang, kategori produk, serta transaksi kasir secara efisien.
            </p>
        </div>
    </div>

    <!-- Section: Profil & Detail Toko -->
    <div class="card border-0 shadow-sm rounded-4 p-4 mb-5">
        <div class="card-body">
            <div class="row align-items-center g-4">
                <div class="col-md-4 text-center">
                    <div class="p-4 bg-primary bg-opacity-10 rounded-4 d-inline-block">
                        <i class="bi bi-bag-fill display-1 text-primary"></i>
                    </div>
                </div>
                <div class="col-md-8">
                    <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-bold mb-2">
                        Profil Usaha
                    </span>
                    <h3 class="fw-bold text-dark mb-2">Step Up Shoes Store</h3>
                    <p class="text-muted mb-0">
                        Pusat penyedia berbagai jenis sepatu berkualitas tinggi, trendi, dan nyaman untuk segala aktivitas. Kami melayani pembelian eceran maupun grosir untuk kebutuhan gaya kasual, olahraga, formal, dan trend terkini.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Kategori Produk Sepatu -->
    <div class="mb-5">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-dark mb-1">Kategori Produk Kami</h4>
            <p class="text-muted small">Berbagai jenis koleksi sepatu yang dikelola di dalam sistem</p>
        </div>

        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 text-center p-3 feature-card">
                    <div class="card-body p-2">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-activity fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Sneakers & Casual</h6>
                        <small class="text-muted">Sepatu santai dan tren harian</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 text-center p-3 feature-card">
                    <div class="card-body p-2">
                        <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-lightning-charge fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Running & Sport</h6>
                        <small class="text-muted">Sepatu olahraga dan lari performa tinggi</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 text-center p-3 feature-card">
                    <div class="card-body p-2">
                        <div class="icon-box bg-warning bg-opacity-10 text-warning rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-briefcase fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Formal & Loafers</h6>
                        <small class="text-muted">Koleksi kerja dan acara resmi</small>
                    </div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card border-0 shadow-sm rounded-4 text-center p-3 feature-card">
                    <div class="card-body p-2">
                        <div class="icon-box bg-info bg-opacity-10 text-info rounded-circle mx-auto mb-3 d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;">
                            <i class="bi bi-shield-check fs-4"></i>
                        </div>
                        <h6 class="fw-bold text-dark mb-1">Boots & Sandals</h6>
                        <small class="text-muted">Sepatu boots dan alas kaki protektif</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Fitur Utama Sistem POS -->
    <div class="mb-5">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-dark mb-1">Fitur Utama Sistem</h4>
            <p class="text-muted small">Layanan sistem Point of Sales yang mendukung operasional toko</p>
        </div>

        <div class="row g-4">
            <!-- Card 1: Manajemen Produk -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 text-center p-3 feature-card">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="icon-box bg-primary bg-opacity-10 text-primary rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-box-seam fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Manajemen Produk</h5>
                        <p class="text-muted small mb-0">Kelola data stok sepatu, ukuran, warna, dan harga dengan terorganisir.</p>
                    </div>
                </div>
            </div>

            <!-- Card 2: Transaksi Penjualan -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 text-center p-3 feature-card">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="icon-box bg-success bg-opacity-10 text-success rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-cart-check fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Transaksi Penjualan</h5>
                        <p class="text-muted small mb-0">Proses kasir yang intuitif, pencetakan nota, dan rekap transaksi cepat.</p>
                    </div>
                </div>
            </div>

            <!-- Card 3: Akses Berbasis Role -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 text-center p-3 feature-card">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="icon-box bg-warning bg-opacity-10 text-warning rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-shield-lock fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Akses Berbasis Role</h5>
                        <p class="text-muted small mb-0">Hak akses bertingkat yang membedakan otoritas Admin dan Kasir.</p>
                    </div>
                </div>
            </div>

            <!-- Card 4: Identifikasi Pelanggan -->
            <div class="col-md-6 col-lg-3">
                <div class="card h-100 border-0 shadow-sm rounded-4 text-center p-3 feature-card">
                    <div class="card-body d-flex flex-column align-items-center">
                        <div class="icon-box bg-info bg-opacity-10 text-info rounded-circle d-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px;">
                            <i class="bi bi-people fs-3"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Data Pelanggan</h5>
                        <p class="text-muted small mb-0">Pencatatan identitas dan preferensi pembeli untuk analisa penjualan.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Pengembang Sistem -->
    <div class="mb-5">
        <div class="text-center mb-4">
            <h4 class="fw-bold text-dark mb-1">Pengembang Sistem</h4>
            <p class="text-muted small">Di balik pembuatan dan pemeliharaan aplikasi POS</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-12 col-md-5 col-lg-4">
                <div class="card border-0 shadow-sm rounded-4 text-center p-4 feature-card">
                    <img src="<?php echo e(asset('images/p.png')); ?>" 
                         alt="Foto Pengembang" 
                         class="rounded-circle mx-auto mb-3 border border-4 border-primary shadow-sm" 
                         style="width: 110px; height: 110px; object-fit: cover;"
                         onerror="this.onerror=null;this.src='https://via.placeholder.com/110';">
                    <h5 class="fw-bold text-dark mb-1">IKRIMATUZAHRA</h5>
                    <p class="text-muted small mb-2">Fullstack Developer</p>
                    <div>
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 small fw-semibold">
                            Lead Developer & Designer
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section: Kontak, Jam Operasional & Media Sosial (Paling Bawah) -->
    <div class="card border-0 shadow-sm rounded-4 p-4">
        <div class="card-body">
            <h5 class="fw-bold text-dark mb-4">
                <i class="bi bi-geo-alt text-primary me-2"></i>Informasi Kontak & Operasional
            </h5>
            <div class="row g-3 text-start">
                <!-- Alamat -->
                <div class="col-sm-6">
                    <div class="p-3 bg-light rounded-3 border d-flex align-items-center h-100">
                        <div class="bg-danger bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="bi bi-geo-alt-fill text-danger fs-5"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">Alamat Toko</span>
                            <span class="fw-bold text-dark small">Jl. Raya Tasikmalaya No. 123</span>
                        </div>
                    </div>
                </div>

                <!-- WhatsApp -->
                <div class="col-sm-6">
                    <div class="p-3 bg-light rounded-3 border d-flex align-items-center h-100">
                        <div class="bg-success bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="bi bi-whatsapp text-success fs-5"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">WhatsApp</span>
                            <span class="fw-bold text-dark small">+62 857-2451-5386</span>
                        </div>
                    </div>
                </div>

                <!-- Jam Operasional -->
                <div class="col-sm-6">
                    <div class="p-3 bg-light rounded-3 border d-flex align-items-center h-100">
                        <div class="bg-primary bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="bi bi-clock-fill text-primary fs-5"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">Jam Operasional</span>
                            <span class="fw-bold text-dark small">Buka Setiap Hari (08.00 - 21.00 WIB)</span>
                        </div>
                    </div>
                </div>

                <!-- Instagram -->
                <div class="col-sm-6">
                    <div class="p-3 bg-light rounded-3 border d-flex align-items-center h-100">
                        <div class="bg-danger bg-opacity-10 p-2 rounded-circle me-3">
                            <i class="bi bi-instagram text-danger fs-5"></i>
                        </div>
                        <div>
                            <span class="text-muted small d-block">Instagram</span>
                            <span class="fw-bold text-dark small">@ikrmzzz</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .feature-card {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
    }
    .feature-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.1) !important;
    }
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\pos_imoy\resources\views/tentang/index.blade.php ENDPATH**/ ?>