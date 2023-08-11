<?= $this->extend('mystyle/index'); ?>

<?= $this->section('konten'); ?>

<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Orders List</h3>
                </div>
                <?php if (session()->getFlashdata('message') !== NULL) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo session()->getFlashdata('message'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div> <!-- Row end  -->

        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Kd pesanan</th>
                                    <th>Nama pembeli</th>
                                    <th>No Telepon</th>
                                    <th>Alamat</th>
                                    <th>Jumlah barang</th>
                                    <th>Total harga</th>
                                    <th>Bukti pembayaran</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($kd_pesanan as $kode_pesanan) : ?>
                                    <tr>
                                        <td>#<?= $kode_pesanan->kd_pesanan ?></td>
                                        <td><?= $kode_pesanan->nama_pembeli ?></td>
                                        <td><?= $kode_pesanan->telp ?></td>
                                        <td><?= $kode_pesanan->alamat ?></td>
                                        <td><?= $kode_pesanan->jml_barang ?></td>
                                        <td>Rp. <?= number_format($kode_pesanan->total_harga) ?></td>
                                        <td> <a href="<?= base_url() ?>mystyle/bukti_pembayaran/<?= $kode_pesanan->bukti_pembayaran ?>" target="_blank"><img src="<?= base_url() ?>mystyle/bukti_pembayaran/<?= $kode_pesanan->bukti_pembayaran ?>" width="100px"></a></td>
                                        <td><?= $kode_pesanan->status_transaksi == 'SELESAI' ? '<span class="badge bg-success">' . $kode_pesanan->status_transaksi . '</span>' : '<span class="badge bg-danger">' . $kode_pesanan->status_transaksi . '</span>'  ?></td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expadd<?= $kode_pesanan->kd_pesanan ?>">
                                                    <i class="icofont-edit text-success"></i>
                                                </button>
                                                <a data-href="<?= base_url('admin/orders_list/' . $kode_pesanan->kd_pesanan . '/delete') ?>" onclick="confirmToDelete(this)" data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete">
                                                    <button type="button" class="btn btn-outline-secondary deleterow" data-bs-toggle="modal" data-bs-target="#delete<?= $kode_pesanan->kd_pesanan ?>">
                                                        <i class="icofont-ui-delete text-danger" style="color:white"></i>
                                                    </button>
                                                </a>

                                                <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#detail<?= $kode_pesanan->kd_pesanan ?>">
                                                    <i class="icofont-eye text-success"></i>
                                                </button>
                                                <a target="_blank" class="btn btn-outline-info" href="<?= base_url() . 'invoice/' . $kode_pesanan->kd_pesanan ?>">
                                                    <i class="icofont-file-pdf text-success"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>

                                    <!-- MODAL Detail PRODUK -->
                                    <div class="modal fade" id="detail<?= $kode_pesanan->kd_pesanan ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title  fw-bold" id="expaddLabel">Detail Pesanan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="deadline-form">
                                                        <div class="row">
                                                            <div class="col-lg-6">
                                                                <div class="d-flex mx-3">
                                                                    <span>Kode Pemesanan :#&nbsp; </span>
                                                                    <span><?= $kode_pesanan->kd_pesanan ?></span>
                                                                </div>
                                                                <div class="d-flex mx-3">
                                                                    <span>Nama Pembeli :&nbsp; </span>
                                                                    <span><?= $kode_pesanan->nama_pembeli ?></span>
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="d-flex mx-3">
                                                                    <span>Alamat :&nbsp; </span>
                                                                    <span><?= $kode_pesanan->alamat ?></span>
                                                                </div>
                                                                <div class="d-flex mx-3">
                                                                    <span>No Telepon :&nbsp; </span>
                                                                    <span><?= $kode_pesanan->telp ?></span>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <?php
                                                            $db = db_connect();
                                                            $query = $db->query("SELECT *, tb_barang.nama_barang FROM tb_transaksi INNER JOIN tb_barang ON tb_transaksi.kd_barang = tb_barang.kd_barang WHERE kd_pesanan = '" . $kode_pesanan->kd_pesanan . "'");
                                                            //you get result as an array in here but fetch your result however you feel to
                                                            $result = $query->getResultArray();
                                                            ?>
                                                            <div class="col-lg-12">
                                                                <div class="d-flex mx-3">
                                                                    <span>Detail Barang </span>
                                                                </div>
                                                                <?php foreach ($result as $v) : ?>
                                                                    <div class="d-flex mt-3 justify-content-between">
                                                                        <div class="d-flex mx-3">
                                                                            <span>Nama :&nbsp; </span>
                                                                            <span><?= $v['nama_barang'] ?></span>
                                                                        </div>
                                                                        <div class="d-flex mx-3">
                                                                            <span>Qty :&nbsp; </span>
                                                                            <span><?= $v['jml_barang'] ?></span>
                                                                        </div>
                                                                        <div class="d-flex mx-3">
                                                                            <span>Total :&nbsp; </span>
                                                                            <span>Rp.<?= number_format($v['total_harga']) ?></span>
                                                                        </div>
                                                                    </div>
                                                                <?php endforeach; ?>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <br>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END MODAL -->

                                    <!-- MODAL EDIT PRODUK -->
                                    <div class="modal fade" id="expadd<?= $kode_pesanan->kd_pesanan ?>" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <form action="<?= base_url() ?>admin/ubah_status_pesanan/<?= $kode_pesanan->kd_pesanan ?>" method="post" enctype="multipart/form-data">
                                                    <?= csrf_field(); ?>

                                                    <div class="modal-header">
                                                        <h5 class="modal-title  fw-bold" id="expaddLabel">PROSES PESANAN</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        <div class="deadline-form">

                                                            <div class="row g-3 mb-3">
                                                                <div class="row g-3 mb-3">
                                                                    <div class="col-sm-6">
                                                                        <label for="abc11" class="form-label">TANGGAL BARANG DIKIRIM</label>
                                                                        <input name="tanggal_kirim" id="admitdate" type="date" class="form-control" required value="<?= $kode_pesanan->tanggal_kirim ?>">
                                                                    </div>
                                                                    <div class="col-sm-6">
                                                                        <label for="abc111" class="form-label">TANGGAL BARANG SAMPAI</label>
                                                                        <input name="tanggal_sampai" id="admitdate" type="date" class="form-control" required value="<?= $kode_pesanan->tanggal_sampai ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-sm-12">
                                                                    <label for="item" class="form-label">STATUS TRANSAKSI</label>
                                                                    <select class="select form-control" name="status_transaksi" required>
                                                                        <option> - PILIH - </option>
                                                                        <option value="PROSES KIRIM" <?= $kode_pesanan->status_transaksi === 'PROSES KIRIM' ? 'selected' : '' ?>>PROSES KIRIM</option>
                                                                        <option value="SELESAI" <?= $kode_pesanan->status_transaksi === 'SELESAI' ? 'selected' : '' ?>>SELESAI</option>
                                                                    </select>
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
    $('.deleterow').on('click', function() {
        var tablename = $(this).closest('table').DataTable();
        tablename
            .row($(this)
                .parents('tr'))
            .remove()
            .draw();

    });
</script>

<?= $this->endSection(); ?>