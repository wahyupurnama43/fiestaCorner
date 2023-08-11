<?= $this->extend('auth/assets'); ?>

<?= $this->section('auth'); ?>

<div class="body d-flex p-0 p-xl-5">
    <div class="container-xxl">

        <div class="row g-0">
            <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                <div style="max-width: 25rem;">
                    <div class="text-center mb-5">
                        <i class="bi bi-bag-check-fill  text-primary" style="font-size: 90px;"></i>
                    </div>
                    <div class="mb-5">
                        <h2 class="color-900 text-center">A few clicks is all it takes.</h2>
                    </div>
                    <!-- Image block -->
                    <div class="">
                        <img src="<?= base_url() ?>mystyle/assets/images/login-img.svg" alt="login-img">
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                <div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 32rem;"><br>
                    <!-- Form -->
                    <form class="row g-1 p-3 p-md-4" action="<?= url_to('register') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="col-12 text-center mb-5">
                            <h4>Register</h4>
                            <span>Belanja apapun jadi lebih mudah disini.</span>
                        </div>
                        <?= view('Myth\Auth\Views\_message_block') ?>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Username</label>
                                <input name="username" type="text" class="form-control form-control-lg <?php if (session('errors.username')) : ?>is-invalid<?php endif ?>" name="username" placeholder="<?= lang('Auth.username') ?>" value="<?= old('username') ?>">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-2">
                                <label class="form-label">Email address</label>
                                <input name="email" type="email" class="form-control form-control-lg <?php if (session('errors.email')) : ?>is-invalid<?php endif ?>" id="email" placeholder="Email" value="<?= old('email') ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label class="form-label">Nama Lengkap</label>
                                <input name="nama_lengkap" type="text" class="form-control form-control-lg <?php if (session('errors.nama_lengkap')) : ?>is-invalid<?php endif ?>" id="nama_lengkap" placeholder="Nama Lengkap" value="<?= old('nama_lengkap') ?>">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label class="form-label">Password</label>
                                <input name="password" type="password" class="form-control form-control-lg <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.password') ?>" id="password" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="mb-2">
                                <label class="form-label">Confirm password</label>
                                <input name="pass_confirm" type="password" class="form-control form-control-lg <?php if (session('errors.pass_confirm')) : ?>is-invalid<?php endif ?>" placeholder="<?= lang('Auth.repeatPassword') ?>" id="confirm-password" autocomplete="off">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                <label class="form-check-label" for="flexCheckDefault">
                                    I accept the <a href="" title="Terms and Conditions" class="text-secondary">Terms and Conditions</a>
                                </label>
                            </div>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" alt="SIGNUP">SIGN UP</button>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <span>Already have an account? <a href="<?= base_url() ?>login" title="Sign in" class="text-secondary">Sign in here</a></span>
                        </div>
                    </form>
                    <!-- End Form -->

                </div>
            </div>
        </div> <!-- End Row -->

    </div>
</div>

<?= $this->endSection(); ?>