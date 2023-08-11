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
                                                <th>ID pembeli</th>
                                                <th>KD barang</th>
                                                <th>Jumlah barang</th>
                                                <th>Total harga</th>
                                                <th>Bukti pembayaran</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($kd_pesanan as $kode_pesanan): ?>
                                            <tr>
                                                <td><strong><?= $kode_pesanan->kd_pesanan ?></strong></td>
                                                <td>
                                                    <?php foreach($pembeli as $id_pembeli): ?>
                                                        <?= $id_pembeli->id_pembeli ?>
                                                    <?php endforeach;  ?>
                                                </td>
                                                <td>
                                                    <?php foreach($kode_barang as $kd_barang): ?>
                                                        <?= $kd_barang->kd_barang ?><br>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td>
                                                    <?php foreach($jml_barang as $jumlah_barang): ?>
                                                        <?= $jumlah_barang->jml_barang ?><br>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td>
                                                    <?php foreach($total_harga as $tot_harga): ?>
                                                        Rp <?= number_format($tot_harga->total_harga ,0,',','.') ?><br>
                                                    <?php endforeach; ?>
                                                </td>
                                                <td>
                                                <?php foreach($bukti_pembayaran as $buk_pem): ?>
                                                  <a href="<?= base_url() ?>mystyle/bukti_pembayaran/<?= $buk_pem->bukti_pembayaran ?>" target="_blank"><img src="<?= base_url() ?>mystyle/bukti_pembayaran/<?= $buk_pem->bukti_pembayaran ?>" width="100px"></a>
                                                <?php endforeach; ?>
                                                </td>
                                                <td>
                                                    <div class="btn-group" role="group" aria-label="Basic outlined example">
                                                        <button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#expadd<?= $kode_pesanan->kd_pesanan ?>"><i class="icofont-edit text-success"></i></a>
                                                        <a data-href="<?= base_url('admin/orders_list/'.$kode_pesanan->kd_pesanan.'/delete') ?>"  onclick="confirmToDelete(this)"  data-bs-toggle="tooltip" data-placement="top" title="" data-bs-original-title="Delete">
                                                            <button type="button" class="btn btn-outline-secondary deleterow" data-bs-toggle="modal" data-bs-target="#delete<?= $kode_pesanan->kd_pesanan ?>"><i class="icofont-ui-delete text-danger" style="color:white"></i></button>
                                                        </a>                                                    
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            <!-- MODAL EDIT PRODUK -->
                                            <div class="modal fade" id="expadd<?= $kode_pesanan->kd_pesanan ?>" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-md modal-dialog-scrollable">
                                                            <div class="modal-content">
                                                <form action="<?= base_url() ?>admin/ubah_status_pesanan/<?= $kode_pesanan->kd_pesanan ?>"  method="post" enctype="multipart/form-data">
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
                                                                                        <input name="tanggal_kirim" id="admitdate" type="date" class="form-control"  required>
                                                                                    </div>
                                                                                    <div class="col-sm-6">
                                                                                        <label for="abc111" class="form-label">TANGGAL BARANG SAMPAI</label>
                                                                                        <input name="tanggal_sampai" id="admitdate" type="date" class="form-control" required>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-sm-12">
                                                                                    <label for="item" class="form-label">STATUS TRANSAKSI</label>
                                                                                    <select class="select form-control" name="status_transaksi" required>
                                                                                        <option> - PILIH - </option>
                                                                                        <option value="PROSES KIRIM">PROSES KIRIM</option>
                                                                                        <option value="SELESAI">SELESAI</option>
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
                                            function confirmToDelete(el){
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
        .addClass( 'nowrap' )
        .dataTable( {
            responsive: true,
            columnDefs: [
                { targets: [-1, -3], className: 'dt-body-right' }
            ]
        });
        $('.deleterow').on('click',function(){
            var tablename = $(this).closest('table').DataTable();  
            tablename
            .row( $(this)
            .parents('tr') )
            .remove()
            .draw();

        } );
    </script>

<?= $this->endSection(); ?>