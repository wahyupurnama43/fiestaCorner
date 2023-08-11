<?= $this->extend('mystyle/index'); ?>

<?= $this->section('konten'); ?>

<div class="card auth-detailblock">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Data saya untuk pengiriman produk</h6>
                                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#authchange"><i class="icofont-edit"></i></button>
                                </div>
                                <div class="card-body">
                                    <div class="row g-3">
                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-5">Nama lengkap :</label>
                                            <span><strong>-</strong></span>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-5">Nomor hp :</label>
                                            <span><strong>-</strong></span>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label col-6 col-sm-5">Alamat pengiriman:</label>
                                            <span><strong>-</strong></span>
                                        </div>
                                    </div>
                                </div>
                            </div>

<div class="body d-flex py-3">
                <div class="container-xxl">
                    <div class="row align-items-center">
                        <div class="border-0 mb-4">
                            <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
                                <h3 class="fw-bold mb-0">Forms</h3>
                            </div>
                        </div>
                    </div> <!-- Row end  -->

                <div role="alert" class="alert alert-primary">Sebelum melakukan pembelian, silakan isi data pembeli terlebih dulu.</div>

                    <div class="row align-item-center">
                        <div class="col-md-12">
                            <div class="card mb-3">
                                <div class="card-header py-3 d-flex justify-content-between bg-transparent border-bottom-0">
                                    <h6 class="mb-0 fw-bold ">Informasi pelanggan</h6> 
                                </div>
                                <div class="card-body">
                                    <form>
                                        <div class="row g-3 align-items-center">
                                            <div class="col-md-6">
                                                <label for="firstname" class="form-label">Nama lengkap</label>
                                                <input name="nama_pembeli" type="text" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label for="lastname" class="form-label">No telepon</label>
                                                <input name="telp" type="number" class="form-control" required>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Jenis kelamin</label><br>
                                                <select class="select form-control" name="jenis_kelamin" required>
                                                    <option>- PILIH -</option>
                                                    <option value="PRIA">PRIA</option>
                                                    <option value="WANITA">WANITA</option>
                                                </select>
                                            </div>
                                            <div class="col-md-12">
                                                <label class="form-label">Alamat</label>
                                                <textarea type="text" class="form-control" id="phonenumber" required></textarea>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-primary mt-4">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div><!-- Row end  -->

                </div>
            </div>

<?= $this->endSection(); ?>