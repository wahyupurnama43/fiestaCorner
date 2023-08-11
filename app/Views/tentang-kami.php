<?= $this->extend('mystyle/index'); ?>

<?= $this->section('konten'); ?>

<!-- Body: Body -->
<div class="body d-flex py-3">
  <div class="container-xxl">
    <div class="row align-items-center">
      <div class="border-0 mb-4">
        <div class="card-header py-3 no-bg bg-transparent d-flex align-items-center px-0 justify-content-between border-bottom flex-wrap">
          <h3 class="fw-bold mb-0">Tentang Kami <?= $tentang->nama_usaha ?></h3>
        </div>
        <?php if (session()->getFlashdata('message') !== NULL) : ?>
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo session()->getFlashdata('message'); ?>
          </div>
        <?php endif; ?>
      </div>
    </div> <!-- Row end  -->
    <div class="row g-3 mb-3">

      <img src="http://localhost:8080/mystyle/produk/<?= $tentang->foto ?>" alt="">
      <p>
        <?= $tentang->deskripsi ?>
      </p>


      <div class="d-flex gap-3 justify-content-center">
        <p>
          Alamat : <?= $tentang->alamat_usaha ?>
        </p>
        <p>Phone: <?= $tentang->no_tlpn ?></p>
      </div>

    </div>
  </div>
</div>

<?= $this->endSection(); ?>