<?= $this->extend('mystyle/index'); ?>

<?= $this->section('konten'); ?>
<div class="body d-flex py-3">
                <div class="container-xxl">

                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Products Detail</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->  

                    <div class="row g-3 mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="product-details">
                                        <div class="row align-items-center">
                                            <div class="col-lg-6">
                                                <div class="product-details-image mt-50">
                                                    <div class="product-image">
                                                        <div class="product-image-active tab-content" id="v-pills-tabContent">
                                                            <a class="single-image tab-pane fade active show" id="v-pills-five" role="tabpanel" aria-labelledby="v-pills-five-tab">
                                                                <img src="<?= base_url()  ?>mystyle/produk/<?= $barang->gambar ?>" alt="">
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="product-details-content mt-45">
                                                    <h2 class="fw-bold fs-4"><?= $barang->nama_barang ?></h2>
                                                    <div class="product-price">
                                                        <h6 class="price-title fw-bold">Stock : <?= $barang->stok ?></h6>
                                                        <p class="sale-price">Rp <?= number_format($barang->harga_jual,2,',','.'); ?></p>
                                                    </div>
                                                    <p>
                                                         <?= $barang->keterangan ?>
                                                    </p>
                                                    <div class="product-btn mb-5">
                                                        <div class="d-flex flex-wrap">
                                                        <?php if (session()->getFlashdata('message') !== NULL) : ?>
                                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                                <?php echo session()->getFlashdata('message'); ?>
                                                            </div>
                                                        <?php endif; ?>
                                                        <form action="<?= base_url('masukan_keranjang/').$barang->kd_barang ?>" method="post">
                                                            <?= csrf_field(); ?>
                                                            <div class="mt-2 mt-sm-0  me-1">
                                                                <div class="input-group">
                                                                    <input name="id_barang" value="<?= $barang->kd_barang ?>" type="text" hidden>
                                                                    <input name="total_barang" type="number" class="form-control" placeholder="1" min="1" required>
                                                                    <span class="input-group-text"><i class="fa fa-sort"></i></span>
                                                                </div>
                                                            </div><br>
                                                            <button type="submit" class="btn btn-primary mx-1 mt-2 mt-sm-0 w-sm-100"><i class="fa fa-shopping-cart me-1"></i> Add to Cart</button>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> <!-- Row end  -->  
           
                </div>
            </div>


<?= $this->endSection(); ?>