<?= $this->extend('mystyle/index'); ?>

<?= $this->section('konten'); ?>

<!-- Body: Body -->
<div class="body d-flex py-3">
    <div class="container-xxl">
        <div class="row align-items-center">
            <div class="border-0 mb-4">
                <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                    <h3 class="fw-bold mb-0">Tentang Kami</h3>
                </div>
                <?php if (session()->getFlashdata('message') !== NULL) : ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?php echo session()->getFlashdata('message'); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div> <!-- Row end  -->
        <div class="row">
            <form action="<?= base_url() ?>admin/tentang-kami" method="POST" enctype="multipart/form-data">
                <?= csrf_field(); ?>
                <div class="card p-4">
                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="">Nama Usaha</label>
                                <input type="text" name="nama_usaha" class="form-control" value="<?= $tentang->nama_usaha ?>">
                            </div>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="">phone Usaha</label>
                                <input type="text" name="phone_usaha" class="form-control" value="<?= $tentang->no_tlpn ?>">
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="">Foto Usaha</label>
                                <input type="file" name="foto_usaha" class="form-control">
                            </div>
                        </div>

                        <div class="col-lg-6 mb-3">
                            <div class="form-group">
                                <label for="">Alamat Usaha</label>
                                <input type="text" name="alamat_usaha" class="form-control" value="<?= $tentang->alamat_usaha ?>">
                            </div>
                        </div>


                        <div class="col-lg-12 mb-3">
                            <div class="form-group">
                                <label for="">Deskripsi Usaha</label>
                                <textarea name="deskripsi" class="form-control" id="" cols="5" rows="3"><?= $tentang->deskripsi ?></textarea>
                            </div>
                        </div>

                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>

            </form>
        </div>

        <!-- <div class="row g-3 mb-3">

            <img src="http://localhost:8080/mystyle/fiesta.jpg" alt="">
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi accusantium in consequuntur error eius vero amet officia quos, excepturi, commodi ducimus ratione optio facilis velit. Cupiditate facere voluptatum laudantium enim.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit eum cumque quibusdam! Enim facilis cupiditate impedit cumque veritatis illo laborum voluptas, numquam vel eius hic sint quos quaerat sunt ipsum.
            </p>


            <div class="d-flex gap-3 justify-content-center">
                <p>
                    Alamat : jln.asdasd
                </p>
                <p>Phone: 08123123</p>
            </div>

        </div> -->
    </div>
</div>

<?= $this->endSection(); ?>