<?= $this->extend('mystyle/index'); ?>

<?= $this->section('konten'); ?>
            <!-- Body: Body -->
            <div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row">
                <?php foreach($barang as $produk):  ?>    
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="product">
                                <div class="product-image">
                                    <div class="product-item active">
                                        <img src="<?= base_url() ?>mystyle/produk/<?= $produk->gambar ?>" alt="product" class="img-fluid w-100">
                                    </div>
                                    <a class="add-wishlist" href="#">
                                        <i class="bi bi-heart-fill text-danger"></i>
                                    </a>
                                </div>
                                <div class="product-content p-3 text-center">
                                <span class="d-block fw-bold fs-5 text-secondary">Rp <?= number_format($produk->harga_jual,2,',','.'); ?></span>
                                    <a class="fw-bold"><?= $produk->nama_barang ?> </a><br>
                                    <a href="<?= base_url() ?>produk/info/<?= $produk->kd_barang ?>" class="btn btn-primary mt-3">Beli</a>
                                </div>
                            </div>
                        </div>
                   </div>

                <?php endforeach; ?>  
        </div> <!-- Row end  -->
    </div>
</div>

<?= $this->endSection(); ?>