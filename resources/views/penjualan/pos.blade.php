@extends('layouts.app')

@section('title', 'POS')

@section('content')

{{-- Alert Error --}}
@if (session('errors'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('errors') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<h4 class="mb-3 fw-bold">Point of Sale (POS)</h4>

<div class="row g-3">

    {{-- ================== DAFTAR PRODUK ================== --}}
    <div class="col-md-6">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <!-- Form Pencarian -->
                <form method="GET" action="{{ route('penjualan.create') }}">
                    <div class="input-group">
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
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
                @forelse ($products as $product)
                    <form method="POST" action="{{ route('itempenjualan.store') }}" class="row g-2 mb-2 align-items-center">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="penjualan_id" value="{{ $sale->id }}">

                        <!-- Tombol Informasi Produk -->
                        <div class="col-7">
                            <div class="btn btn-outline-primary w-100 text-start p-2 d-flex align-items-center gap-2 disabled-link">
                                @if($product->foto)
                                    <img src="{{ asset('storage/'.$product->foto) }}"
                                         alt="{{ $product->nama }}"
                                         class="rounded-circle"
                                         style="width:45px; height:45px; object-fit:cover;">
                                @else
                                    <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:45px; height:45px">
                                        <i class="bi bi-box-seam"></i>
                                    </div>
                                @endif

                                <div>
                                    <div class="fw-semibold text-truncate" style="max-width: 150px;">{{ $product->nama }}</div>
                                    <small class="text-muted">Rp {{ number_format($product->harga_jual, 0, ',', '.') }}</small>
                                </div>
                            </div>
                        </div>

                        <!-- Input Kuantitas -->
                        <div class="col-3">
                            <input type="number" 
                                   name="quantity" 
                                   value="1" 
                                   min="1"
                                   max="{{ $product->stok }}"
                                   class="form-control"
                                   {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                        </div>

                        <!-- Tombol Tambah ke Keranjang -->
                        <div class="col-2">
                            <button class="btn btn-primary w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}" 
                                    type="submit" 
                                    title="Tambah">
                                +
                            </button>
                        </div>
                    </form>
                @empty
                    <div class="text-center text-muted py-4">
                        Produk tidak ditemukan.
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    {{-- ==================== KERANJANG ==================== --}}
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
                        @forelse($sale->itemPenjualan as $item)
                            <tr>
                                <td class="fw-medium">{{ $item->produk->nama }}</td>
                                <td>Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
                                <td>
                                    <!-- Update Kuantitas Keranjang -->
                                    <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                        @csrf 
                                        @method('PUT')
                                        <input type="number" 
                                               name="quantity"
                                               value="{{ $item->kuantitas }}"
                                               min="1"
                                               class="form-control form-control-sm"
                                               onchange="this.form.submit()"
                                               {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                    </form>
                                </td>
                                <td class="fw-semibold">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    @can('delete', $item)
                                        <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-outline-danger btn-sm" {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                                Hapus
                                            </button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-muted py-4">
                                    Keranjang Masih Kosong
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Total & Checkout -->
            <div class="card-footer bg-white p-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="fs-5 fw-bold">Total Pembayaran:</span>
                    <span class="fs-4 fw-bold text-success">Rp {{ number_format($sale->total_pembayaran ?? 0, 0, ',', '.') }}</span>
                </div>

                <!-- Form Checkout -->
                <form method="POST" 
                      action="{{ route('penjualan.update', $sale->id) }}" 
                      onsubmit="return confirm('Yakin ingin menyelesaikan transaksi ini?')" 
                      class="mb-2">
                    @csrf
                    @method('PUT')
                    
                    <select name="payment_method"
                            id="payment-method"
                            class="form-select mb-2"
                            required
                            {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                        <option value="">-- Pilih Metode Pembayaran --</option>
                        <option value="CASH">Cash (Tunai)</option>
                        <option value="QRIS">QRIS</option>
                    </select>

                    <div id="cash-payment" class="border rounded p-3 mb-3 d-none"
                         data-total="{{ $sale->itemPenjualan->sum('subtotal') }}">
                        <label for="amount-paid" class="form-label fw-semibold">Uang Dibayar</label>
                        <div class="input-group">
                            <span class="input-group-text">Rp</span>
                            <input type="number"
                                   name="amount_paid"
                                   id="amount-paid"
                                   class="form-control"
                                   min="{{ $sale->itemPenjualan->sum('subtotal') }}"
                                   step="1"
                                   inputmode="numeric"
                                   placeholder="Masukkan nominal uang"
                                   {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                        </div>
                        <div class="d-flex justify-content-between mt-2 small">
                            <span class="text-muted">Kembalian</span>
                            <strong id="change-amount">Rp 0</strong>
                        </div>
                    </div>

                    <div id="qris-payment" class="border rounded p-3 mb-3 text-center d-none">
                        <p class="fw-semibold mb-2">Scan QRIS untuk membayar</p>
                        <img src="{{ asset('images/qris.svg') }}"
                             alt="QRIS pembayaran"
                             class="img-fluid rounded"
                             style="max-width: 240px;"
                             onerror="this.classList.add('d-none'); this.nextElementSibling.classList.remove('d-none');">
                        <p class="qris-missing text-muted small mb-0 d-none">
                            QRIS belum tersedia. Simpan QRIS merchant sebagai
                            <strong>public/images/qris.svg</strong>.
                        </p>
                    </div>

                    <button class="btn btn-success w-100 py-2 fw-semibold {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                        Checkout / Selesaikan Transaksi
                    </button>
                </form>

                <!-- Form Batalkan Transaksi -->
                @can('delete', $sale)
                    <form action="{{ route('penjualan.destroy', $sale->id) }}"
                          method="POST"
                          onsubmit="return confirm('Yakin ingin membatalkan seluruh transaksi ini?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-outline-danger w-100 {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}">
                            Batalkan Transaksi
                        </button>
                    </form>
                @endcan
            </div>
        </div>
    </div>

</div>

<script>
    const paymentMethod = document.getElementById('payment-method');
    const qrisPayment = document.getElementById('qris-payment');
    const cashPayment = document.getElementById('cash-payment');
    const amountPaid = document.getElementById('amount-paid');
    const changeAmount = document.getElementById('change-amount');
    const totalPayment = Number(cashPayment?.dataset.total || 0);

    const formatRupiah = (amount) => `Rp ${new Intl.NumberFormat('id-ID').format(Math.max(amount, 0))}`;

    const updatePaymentFields = () => {
        const isCash = paymentMethod?.value === 'CASH';
        cashPayment?.classList.toggle('d-none', !isCash);
        qrisPayment?.classList.toggle('d-none', paymentMethod?.value !== 'QRIS');

        if (amountPaid) {
            amountPaid.required = isCash;
        }

        const paid = Number(amountPaid?.value || 0);
        if (changeAmount) {
            changeAmount.textContent = formatRupiah(paid - totalPayment);
        }
    };

    paymentMethod?.addEventListener('change', updatePaymentFields);
    amountPaid?.addEventListener('input', updatePaymentFields);
</script>

@endsection