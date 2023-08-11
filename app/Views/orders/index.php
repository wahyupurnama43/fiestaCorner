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
            </div>
        </div> <!-- Row end  -->
        <div class="row g-3 mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Invoice</th>
                                    <th>Quantity</th>
                                    <th>Total harga</th>
                                    <th>Tanggal kirim</th>
                                    <th>Tanggal sampai</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php $i = 1;
                                foreach ($orders as $pesanan) :  ?>
                                    <tr>
                                        <td><?= $i++ ?></td>
                                        <td><a href="order-details.html">
                                                <strong>
                                                    #<?= $pesanan->kd_pesanan ?>
                                                </strong></a>
                                        </td>
                                        <td><?= $pesanan->jml_barang ?></td>
                                        <td>
                                            Rp <?= number_format($pesanan->total_harga, 0, ',', '.') ?>
                                        </td>
                                        <td><?= ($pesanan->tanggal_kirim == NULL)  ? "-" : $pesanan->tanggal_kirim; ?></td>
                                        <td><?= ($pesanan->tanggal_sampai == NULL) ? "-" : $pesanan->tanggal_sampai; ?></td>
                                        <td><span class="badge bg-<?= ($pesanan->status_transaksi == 'MENUNGGU KONFIRMASI') ? "warning" : "success" ?>"><?= $pesanan->status_transaksi ?></span></td>
                                        <td>
                                            <button class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#detail<?= $pesanan->kd_pesanan ?>">
                                                <i class="icofont-eye text-success"></i>
                                            </button>
                                            <a target="_blank" class="btn btn-outline-info" href="<?= base_url() . 'invoice/' . $pesanan->kd_pesanan ?>">
                                                <i class="icofont-file-pdf text-success"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- MODAL Detail PRODUK -->
                                    <div class="modal fade" id="detail<?= $pesanan->kd_pesanan ?>" tabindex="-1" aria-hidden="true">
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
                                                                    <span><?= $pesanan->kd_pesanan ?></span>
                                                                </div>
                                                                <div class="d-flex mx-3">
                                                                    <span>Nama Pembeli :&nbsp; </span>
                                                                    <span><?= $pesanan->nama_pembeli ?></span>
                                                                </div>

                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="d-flex mx-3">
                                                                    <span>Alamat :&nbsp; </span>
                                                                    <span><?= $pesanan->alamat ?></span>
                                                                </div>
                                                                <div class="d-flex mx-3">
                                                                    <span>No Telepon :&nbsp; </span>
                                                                    <span><?= $pesanan->telp ?></span>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <?php
                                                            $db = db_connect();
                                                            $query = $db->query("SELECT *, tb_barang.nama_barang,tb_barang.gambar FROM tb_transaksi INNER JOIN tb_barang ON tb_transaksi.kd_barang = tb_barang.kd_barang WHERE kd_pesanan = '" . $pesanan->kd_pesanan . "'");
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
                                                                            <span><img src="<?= base_url() ?>mystyle/produk/<?= $v['gambar'] ?>" class="avatar lg rounded me-2" alt="profile-image"> </span>
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
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- Row end  -->
    </div>
</div>


<?= $this->endSection(); ?>