<?= $this->extend('mystyle/index') ?>

<?= $this->section('konten') ?>

<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Products List</h3>
                    <button type="button" class="btn btn-primary btn-set-task w-sm-100" data-bs-toggle="modal" data-bs-target="#expadd"><i class="icofont-plus-circle me-2 fs-6"></i>Tambah</button>
                </div>
                <?php if (session()->getFlashdata('message') !== NULL) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo session()->getFlashdata('message'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div> <!-- Row end  -->

        <!-- MODAL ADD PRODUK -->
        <form action="<?= base_url() ?>admin/tambah_produk" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="modal fade" id="expadd" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  fw-bold" id="expaddLabel">Add Products</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body">
                            <div class="deadline-form">

                                <div class="row g-3 mb-3">
                                    <div class="col-sm-12">
                                        <label for="item" class="form-label">NAMA BARANG</label>
                                        <input name="nama_barang" type="text" class="form-control" id="item" required>
                                    </div>
                                    <div class="row g-3 mb-3">
                                        <div class="col-sm-6">
                                            <label for="abc11" class="form-label">HARGA BELI</label>
                                            <input name="harga_beli" type="number" class="form-control" id="item" required>
                                        </div>
                                        <div class="col-sm-6">
                                            <label for="abc111" class="form-label">HARGA JUAL</label>
                                            <input name="harga_jual" type="number" class="form-control" id="item" required>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="item" class="form-label">STOK</label>
                                        <input name="stok" type="number" class="form-control" id="item" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="taxtno" class="form-label">PHOTO PRODUK</label>
                                        <input name="image" type="file" class="form-control" required>
                                    </div>
                                    <div class="col-sm-12">
                                        <label for="item" class="form-label">KETERANGAN PRODUK</label>
                                        <textarea name="keterangan" type="text" class="form-control" id="item" required></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <!-- END MODAL -->

        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Kd barang</th>
                                    <th>Nama barang</th>
                                    <th>harga beli</th>
                                    <th>harga jual</th>
                                    <th>Stok</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($barang as $produk) : ?>
                                    <tr>
                                        <td><strong><?= $produk->kd_barang ?></strong></td>
                                        <td><img src="<?= base_url() ?>mystyle/produk/<?= $produk->gambar ?>" width="50px"> <?= $produk->nama_barang ?></td>
                                        <td>Rp <?= number_format($produk->harga_beli, 0, ',', '.') ?></td>
                                        <td> Rp <?= number_format($produk->harga_jual, 0, ',', '.') ?></td>
                                        <td><?= $produk->stok ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expadd<?= $produk->kd_barang ?>"><i class="icofont-edit text-success"></i></a>
                                                    <a data-href="<?= base_url('admin/produk/' . $produk->kd_barang . '/delete') ?>" onclick="confirmToDelete(this)" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete">
                                                        <button type="button" class="btn btn-outline-secondary deleterow" data-bs-toggle="modal" data-bs-target="#delete<?= $produk->kd_barang ?>"><i class="icofont-ui-delete text-danger" style="color:white"></i></button>
                                                    </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- MODAL EDIT PRODUK -->
                                    <div class="modal fade" id="expadd<?= $produk->kd_barang ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <form action="<?= base_url() ?>admin/edit_produk/<?= $produk->kd_barang ?>" method="post" enctype="multipart/form-data">
                                                    <?= csrf_field() ?>

                                                    <div class="modal-header">
                                                        <h5 class="modal-title  fw-bold" id="expaddLabel">Edit Products
                                                        </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="deadline-form">

                                                            <div class="row g-3 mb-3">
                                                                <div class="col-sm-12">
                                                                    <label for="item" class="form-label">NAMA
                                                                        BARANG</label>
                                                                    <input name="nama_barang" value="<?= $produk->nama_barang ?>" type="text" class="form-control" id="item" required>
                                                                </div>
                                                                <div class="row g-3 mb-3">
                                                                    <div class="col-sm-6">
                                                                        <label for="abc11" class="form-label">HARGA
                                                                            BELI</label>
                                                                        <input name="harga_beli" value="<?= $produk->harga_beli ?>" type="number" class="form-control" id="item" required>
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label for="abc111" class="form-label">HARGA
                                                                            JUAL</label>
                                                                        <input name="harga_jual" value="<?= $produk->harga_jual ?>" type="number" class="form-control" id="item" required>
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <label for="item" class="form-label">STOK</label>
                                                                    <input name="stok" value="<?= $produk->stok ?>" type="number" class="form-control" id="item" required>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <label for="taxtno" class="form-label">PHOTO
                                                                        PRODUK</label><br>
                                                                    <?php
                                                                    if (!empty($produk->gambar)) {
                                                                        echo '<center><img src="' . base_url("mystyle/produk/$produk->gambar") . '" width="80px"></center>';
                                                                    } ?><br>
                                                                    <input name="image" type="file" class="form-control">
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <label for="item" class="form-label">KETERANGAN
                                                                        PRODUK</label>
                                                                    <textarea name="keterangan" value="<?= $produk->keterangan ?>" type="text" class="form-control" id="item" required><?= $produk->keterangan ?></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">close</button>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END MODAL -->

                                    <!-- MODAL DETELE PRODUK -->
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
            </div>
        </div>
    </div>
</div>

<script>
    $('#myDataTable')
        .addClass('nowrap')
        .dataTable({
            responsive: true,
            columnDefs: [{
                targets: [-1, -3],
                className: 'dt-body-right'
            }]
        });
    $('.deleterow').on('click', function() {
        var tablename = $(this).closest('table').DataTable();
        tablename
            .row($(this)
                .parents('tr'))
            .remove()
            .draw();

    });
</script>

<?= $this->endSection() ?>