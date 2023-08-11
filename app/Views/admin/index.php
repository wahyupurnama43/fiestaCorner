<?= $this->extend('mystyle/index') ?>

<?= $this->section('konten') ?>

<div class="body d-flex py-3">
    <div class="container-xxl">

        <div class="row g-3 mb-3 row-cols-1 row-cols-sm-2 row-cols-md-2 row-cols-lg-2 row-cols-xl-4">
            <div class="col">
                <div class="alert-success alert mb-0">
                    <div class="d-flex align-items-center">
                        <div class="avatar rounded no-thumbnail bg-success text-light"><i class="fa fa-dollar fa-lg"></i>
                        </div>
                        <div class="flex-fill ms-3 text-truncate">
                            <div class="h6 mb-0">Total penjualan</div>
                            <span class="small">Rp
                                <?= number_format($total_penjualan->total_harga, 0, ',', '.') ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="alert-danger alert mb-0">
                    <div class="d-flex align-items-center">
                        <div class="avatar rounded no-thumbnail bg-danger text-light"><i class="fa fa-credit-card fa-lg"></i></div>
                        <div class="flex-fill ms-3 text-truncate">
                            <div class="h6 mb-0">Pending payment</div>
                            <span class="small"><?= $pending_payment->total_harga ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="alert-warning alert mb-0">
                    <div class="d-flex align-items-center">
                        <div class="avatar rounded no-thumbnail bg-warning text-light"><i class="fa fa-smile-o fa-lg"></i></div>
                        <div class="flex-fill ms-3 text-truncate">
                            <div class="h6 mb-0">Success payment</div>
                            <span class="small"><?= $success_payment->total_harga ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="alert-info alert mb-0">
                    <div class="d-flex align-items-center">
                        <div class="avatar rounded no-thumbnail bg-info text-light"><i class="fa fa-shopping-bag" aria-hidden="true"></i></div>
                        <div class="flex-fill ms-3 text-truncate">
                            <div class="h6 mb-0">Total produk</div>
                            <span class="small"><?= $total_produk->kd_barang ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- Row end  -->
    </div>
</div>

<?= $this->endSection() ?>