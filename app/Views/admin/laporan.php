<?= $this->extend('mystyle/index'); ?>

<?= $this->section('konten'); ?>

<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Laporan</h3>
                </div>
                <?php if (session()->getFlashdata('message') !== NULL) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo session()->getFlashdata('message'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div> <!-- Row end  -->

        <div class="row g-3 mb-3">
            <div class="row my-3">
                <div class="col-lg-4">
                    <div class="card p-3">
                        <div class="d-flex justify-content-between">
                            <h1 style="font-size: 20px; font-weight:600;">Total Penjualan </h1>
                            <h5 style="font-size: 20px; font-weight:600;">Rp <?= number_format($total[0]->total_harga) ?></h5>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="col-md-12" style="margin-bottom: 20px">
                            <form action="<?= base_url() ?>admin/laporan_filter_tanggal" method="post">
                                <div class="row">
                                    <div class="col-md-3">
                                        <span>Pilih dari tanggal</span>
                                        <div class="input-group">
                                            <input type="date" name="dari_tanggal" class="form-control pickdate date_range_filter">
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <span>Sampai tanggal</span>
                                        <div class="input-group">
                                            <input type="date" name="sampai_tanggal" class="form-control pickdate date_range_filter2">
                                        </div>
                                    </div>
                                    <div class="col-md-3"><BR>
                                        <button type="submit" class="btn btn-primary">FILTER TANGGAL</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <table id="myDataTable" class="table table-hover align-middle mb-0" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Nama produk</th>
                                    <th>Harga jual</th>
                                    <th>Total terjual</th>
                                    <th>Hasil penjualan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($transaksi as $detail) : ?>
                                    <tr>
                                        <td><strong><?= $detail->tgl_transaksi ?></strong></td>
                                        <td><?= $detail->nama_barang ?>
                                        </td>
                                        <td>Rp <?= number_format($detail->harga_jual, 0, ',', '.') ?>
                                        </td>
                                        <td><?= $detail->jml_barang ?>
                                        </td>
                                        <td>Rp <?= number_format($detail->total_harga, 0, ',', '.') ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>

                            </tbody>

                            <tfoot>
                                <tr>
                                    <td colspan="4" bgcolor="#FFFF00" style="text-align:right;"><b>Total Penjualan</b></td>
                                    <td bgcolor="#ADFF2F" style="text-align:right;"><b>Rp. <?= number_format($total[0]->total_harga) ?></b></td>
                                </tr>
                            </tfoot>
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

<?= $this->endSection(); ?>