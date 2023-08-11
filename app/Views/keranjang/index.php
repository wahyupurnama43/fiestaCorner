<?= $this->extend('mystyle/index'); ?>

<?= $this->section('konten'); ?>


<!-- main body area -->
<div class="main px-lg-4 px-md-4">

    <!-- Body: Body -->
    <div class="body d-flex py-3">
        <div class="container-xxl">
            <div class="row align-items-center">
                <div class="border-0 mb-4">
                    <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                        <h3 class="fw-bold mb-0">Cart Detail</h3>
                    </div>
                </div>
            </div> <!-- Row end  -->
            <div class="row g-3 mb-3 justify-content-center">
                <div class="col-lg-12 col-xl-12 col-xxl-9">
                    <div class="card">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center bg-transparent border-bottom-0">
                            <h6 class="m-0 fw-bold">Order Summary</h6>
                        </div>
                        <div class="card-body">
                            <?php if (session()->getFlashdata('message') !== NULL) : ?>
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <?php echo session()->getFlashdata('message'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="product-cart">
                                <div class="checkout-table">
                                    <div class="table-responsive">
                                        <table id="myCartTable" class="table display dataTable table-hover align-middle" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th class="product">Product Image</th>
                                                    <th>Product Name</th>
                                                    <th class="quantity">Quantity</th>
                                                    <th class="price">Price</th>
                                                    <th class="action">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($keranjang as $barang) : ?>
                                                    <tr>
                                                        <td>
                                                            <img src="<?= base_url() ?>mystyle/produk/<?= $barang->gambar ?>" class="avatar rounded lg" alt="Product">
                                                        </td>
                                                        <td>
                                                            <h6 class="title"><?= $barang->nama_barang ?></h6>
                                                        </td>
                                                        <td>
                                                            <?= $barang->quantity_beli ?>
                                                        </td>
                                                        <td>
                                                            <p class="price"> Rp <?= number_format($barang->total_harga, 0, ',', '.') ?></p>
                                                        </td>
                                                        <td>
                                                            <ul class="action">
                                                                <li><button class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editquantity<?= $barang->id ?>"><i class="icofont-ui-edit" style="color:white"></i></button></li>
                                                                <li>
                                                                    <a data-href="<?= base_url('keranjang/' . $barang->id . '/delete') ?>" onclick="confirmToDelete(this)" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete">
                                                                        <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#delete<?= $barang->id ?>"><i class="icofont-ui-delete" style="color:white"></i></button>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal Edit Quantity produk-->
                                                    <div class="modal fade" id="editquantity<?= $barang->id ?>" tabindex="-1" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title  fw-bold" id="expeditLabel"> Edit Quantity</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <form action="<?= base_url() ?>keranjang/<?= $barang->id ?>" method="post" enctype="multipart/form-data">
                                                                    <?= csrf_field(); ?>
                                                                    <div class="modal-body">

                                                                        <div class="deadline-form">
                                                                            <div class="row g-3 mb-3">
                                                                                <div class="col-sm-12">
                                                                                    <label for="taxtno11" class="form-label">Quantity</label>
                                                                                    <input name="quantity_beli" value="<?= $barang->quantity_beli ?>" type="number" class="form-control" id="taxtno11" placeholder="<?= $barang->quantity_beli ?>">
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- MODAL DETELE ITEM KERANJANG -->
                                                    <div id="confirm-dialog" class="modal" tabindex="-1" role="dialog">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                    <h2 class="h2">Yakin ingin menghapus?</h2>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="#" role="button" id="delete-button" class="btn btn-danger">Delete</a>
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <script>
                                                        function confirmToDelete(el) {
                                                            $("#delete-button").attr("href", el.dataset.href);
                                                            $("#confirm-dialog").modal('show');
                                                        }
                                                    </script>

                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="checkout-coupon-total checkout-coupon-total-2 d-flex flex-wrap mt-3">
                                    <div class="checkout-coupon">
                                    </div>
                                    <div class="checkout-total">
                                        <div class="single-total">
                                            <p class="value">Subotal Price:</p>
                                            <p class="price">Rp <?= number_format($subtotal_price->total_harga, 0, ',', '.') ?></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="checkout-btn d-flex justify-content-between pt-3 flex-wrap mt-2">

                                    <div class="single-btn w-sm-100 mx-auto">
                                        <button class="btn btn-primary w-sm-100" data-bs-toggle="modal" data-bs-target="#bayarsekarang">
                                            Bayar sekarang
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal bayar sekarang -->
    <div class="modal fade" id="bayarsekarang" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title  fw-bold" id="expeditLabel">PAYMENT PROCESS</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="<?= base_url() ?>transaksi_proses" method="post" enctype="multipart/form-data">
                    <?= csrf_field(); ?>
                    <div class="modal-body">
                        <h4>Silakan lakukan transfer pada rekening berikut.</h4><br>
                        BANK BCA <BR>
                        Norek : 12345678 <br>
                        Nominal : Rp <?= number_format($subtotal_price->total_harga, 0, ',', '.') ?><br><br>

                        <div class="deadline-form">
                            <div class="row g-3 mb-3">
                                <div class="col-lg-6">
                                    <label for="nama" class="form-label">Nama Pembeli</label>
                                    <input name="nama" type="text" class="form-control" id="nama" required>
                                </div>

                                <div class="col-lg-6">
                                    <label for="telp" class="form-label">Nomor Pembeli</label>
                                    <input name="telp" type="text" class="form-control" id="telp" required placeholder="628712345678">
                                </div>

                                <div class="col-lg-12">
                                    <label for="alamat" class="form-label">Alamat</label>
                                    <textarea name="alamat" class="form-control" id="alamat" rows="3"></textarea>
                                </div>

                                <div class="col-sm-12">
                                    <label for="taxtno11" class="form-label">Upload bukti pembayaran/transfer</label>
                                    <input name="image" type="file" class="form-control" id="taxtno11" required>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Proccess</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Custom Settings-->
    <div class="modal fade right" id="Settingmodal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog  modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Custom Settings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body custom_setting">
                    <!-- Settings: Color -->
                    <div class="setting-theme pb-3">
                        <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i class="icofont-color-bucket fs-4 me-2 text-primary"></i>Template Color Settings</h6>
                        <ul class="list-unstyled row row-cols-3 g-2 choose-skin mb-2 mt-2">
                            <li data-theme="indigo">
                                <div class="indigo"></div>
                            </li>
                            <li data-theme="tradewind">
                                <div class="tradewind"></div>
                            </li>
                            <li data-theme="monalisa">
                                <div class="monalisa"></div>
                            </li>
                            <li data-theme="blue" class="active">
                                <div class="blue"></div>
                            </li>
                            <li data-theme="cyan">
                                <div class="cyan"></div>
                            </li>
                            <li data-theme="green">
                                <div class="green"></div>
                            </li>
                            <li data-theme="orange">
                                <div class="orange"></div>
                            </li>
                            <li data-theme="blush">
                                <div class="blush"></div>
                            </li>
                            <li data-theme="red">
                                <div class="red"></div>
                            </li>
                        </ul>
                    </div>
                    <div class="sidebar-gradient py-3">
                        <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i class="icofont-paint fs-4 me-2 text-primary"></i>Sidebar Gradient</h6>
                        <div class="form-check form-switch gradient-switch pt-2 mb-2">
                            <input class="form-check-input" type="checkbox" id="CheckGradient">
                            <label class="form-check-label" for="CheckGradient">Enable Gradient! ( Sidebar )</label>
                        </div>
                    </div>
                    <!-- Settings: Template dynamics -->
                    <div class="dynamic-block py-3">
                        <ul class="list-unstyled choose-skin mb-2 mt-1">
                            <li data-theme="dynamic">
                                <div class="dynamic"><i class="icofont-paint me-2"></i> Click to Dyanmic Setting</div>
                            </li>
                        </ul>
                        <div class="dt-setting">
                            <ul class="list-group list-unstyled mt-1">
                                <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                    <label>Primary Color</label>
                                    <button id="primaryColorPicker" class="btn bg-primary avatar xs border-0 rounded-0"></button>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                    <label>Secondary Color</label>
                                    <button id="secondaryColorPicker" class="btn bg-secondary avatar xs border-0 rounded-0"></button>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                    <label class="text-muted">Chart Color 1</label>
                                    <button id="chartColorPicker1" class="btn chart-color1 avatar xs border-0 rounded-0"></button>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                    <label class="text-muted">Chart Color 2</label>
                                    <button id="chartColorPicker2" class="btn chart-color2 avatar xs border-0 rounded-0"></button>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                    <label class="text-muted">Chart Color 3</label>
                                    <button id="chartColorPicker3" class="btn chart-color3 avatar xs border-0 rounded-0"></button>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                    <label class="text-muted">Chart Color 4</label>
                                    <button id="chartColorPicker4" class="btn chart-color4 avatar xs border-0 rounded-0"></button>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                    <label class="text-muted">Chart Color 5</label>
                                    <button id="chartColorPicker5" class="btn chart-color5 avatar xs border-0 rounded-0"></button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- Settings: Font -->
                    <div class="setting-font py-3">
                        <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i class="icofont-font fs-4 me-2 text-primary"></i> Font Settings</h6>
                        <ul class="list-group font_setting mt-1">
                            <li class="list-group-item py-1 px-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="font" id="font-poppins" value="font-poppins">
                                    <label class="form-check-label" for="font-poppins">
                                        Poppins Google Font
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item py-1 px-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="font" id="font-opensans" value="font-opensans" checked="">
                                    <label class="form-check-label" for="font-opensans">
                                        Open Sans Google Font
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item py-1 px-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="font" id="font-montserrat" value="font-montserrat">
                                    <label class="form-check-label" for="font-montserrat">
                                        Montserrat Google Font
                                    </label>
                                </div>
                            </li>
                            <li class="list-group-item py-1 px-2">
                                <div class="form-check mb-0">
                                    <input class="form-check-input" type="radio" name="font" id="font-mukta" value="font-mukta">
                                    <label class="form-check-label" for="font-mukta">
                                        Mukta Google Font
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Settings: Light/dark -->
                    <div class="setting-mode py-3">
                        <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i class="icofont-layout fs-4 me-2 text-primary"></i>Contrast Layout</h6>
                        <ul class="list-group list-unstyled mb-0 mt-1">
                            <li class="list-group-item d-flex align-items-center py-1 px-2">
                                <div class="form-check form-switch theme-switch mb-0">
                                    <input class="form-check-input" type="checkbox" id="theme-switch">
                                    <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-1 px-2">
                                <div class="form-check form-switch theme-high-contrast mb-0">
                                    <input class="form-check-input" type="checkbox" id="theme-high-contrast">
                                    <label class="form-check-label" for="theme-high-contrast">Enable High Contrast</label>
                                </div>
                            </li>
                            <li class="list-group-item d-flex align-items-center py-1 px-2">
                                <div class="form-check form-switch theme-rtl mb-0">
                                    <input class="form-check-input" type="checkbox" id="theme-rtl">
                                    <label class="form-check-label" for="theme-rtl">Enable RTL Mode!</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer justify-content-start">
                    <button type="button" class="btn btn-white border lift" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary lift">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

</div>



<?= $this->endSection(); ?>