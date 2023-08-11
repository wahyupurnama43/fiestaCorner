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
                                                <th>Item</th>
                                                <th>Harga barang</th>
                                                <th>Quantity</th>
                                                <th>Total harga</th>
                                                <th>Tanggal kirim</th>
                                                <th>Tanggal sampai</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($orders as $pesanan):  ?>
                                            <tr>
                                                <td><a href="order-details.html">
                                                    <strong>
                                                        #<?= $pesanan->kd_pesanan ?>
                                                    </strong></a>
                                                </td>
                                                <td><img src="<?= base_url() ?>mystyle/produk/<?= $pesanan->gambar ?>" class="avatar lg rounded me-2" alt="profile-image"><br><span><?= $pesanan->nama_barang ?></span></td>
                                                <td>Rp <?= number_format($pesanan->harga_jual,0,',','.')?></td>
                                                <td><?= $pesanan->jml_barang ?></td>
                                                <td>
                                                Rp  <?=  number_format($pesanan->total_harga,0,',','.') ?>
                                                </td>
                                                <td><?php if($pesanan->tanggal_kirim == NULL){ echo "-";}else{ echo $pesanan->tanggal_kirim;}  ?></td>
                                                <td><?php if($pesanan->tanggal_sampai == NULL){ echo "-";}else{ echo $pesanan->tanggal_sampai;}  ?></td>
                                                <td><span class="badge bg-<?php if($pesanan->status_transaksi == 'MENUNGGU KONFIRMASI'){ echo "warning"; }else{ echo "success";} ?>"><?= $pesanan->status_transaksi ?></span></td>
                                            </tr>
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