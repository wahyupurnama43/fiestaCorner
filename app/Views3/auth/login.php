<?= $this->extend('auth/assets'); ?>

<?= $this->section('auth'); ?>

    <div id="ebazar-layout" class="theme-blue">

        <!-- main body area -->
        <div class="main p-2 py-3 p-xl-5 ">
            
            <!-- Body: Body -->
            <div class="body d-flex p-0 p-xl-5">
                <div class="container-xxl">

                    <div class="row g-0">
                        <div class="col-lg-6 d-none d-lg-flex justify-content-center align-items-center rounded-lg auth-h100">
                            <div style="max-width: 25rem;">
                                <div class="text-center mb-5">
                                    <i class="bi bi-bag-check-fill  text-primary" style="font-size: 90px;"></i>
                                </div>
                                <div class="mb-5">
                                <span><img src="<?= base_url() ?>mystyle/fiesta.jpg" width="400px"></span>
                                </div>
                                <!-- Image block -->
                                <div class="">
                                    <img src="<?= base_url() ?>mystyle/assets/images/login-img.svg" alt="login-img">
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-6 d-flex justify-content-center align-items-center border-0 rounded-lg auth-h100">
                            <div class="w-100 p-3 p-md-5 card border-0 shadow-sm" style="max-width: 32rem;">
                                <!-- Form -->
                              
                                <form class="row g-1 p-3 p-md-4" action="<?= url_to('login') ?>" method="post">
                                  <?= csrf_field() ?>
                                    <div class="col-12 text-center mb-5">
                                        <h1>Sign in</h1>
                                        <span>Belanja apapun jadi lebih mudah disini.</span>
                                    </div>
                                    <?= view('Myth\Auth\Views\_message_block') ?>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <label class="form-label">Email address</label>
                                            <input name="login" type="email" class="form-control form-control-lg <?php if (session('errors.login')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.email')?>">
                                              <div class="invalid-feedback">
                                                <?= session('errors.login') ?>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <div class="mb-2">
                                            <div class="form-label">
                                                <span class="d-flex justify-content-between align-items-center">
                                                    Password
                                                    <a class="text-secondary" href="auth-password-reset.html">Forgot Password?</a>
                                                </span>
                                            </div>
                                            <input name="password" type="password" class="form-control form-control-lg <?php if (session('errors.password')) : ?>is-invalid<?php endif ?>" placeholder="<?=lang('Auth.password')?>">
                                              <div class="invalid-feedback">
                                                  <?= session('errors.password') ?>
                                              </div>
                                         </div>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <button type="submit" class="btn btn-lg btn-block btn-light lift text-uppercase" atl="signin">SIGN IN</button>
                                    </div>
                                    <div class="col-12 text-center mt-4">
                                        <span>Don't have an account yet? <a href="<?= base_url() ?>register" class="text-secondary">Sign up here</a></span>
                                    </div>
                                </form>
                                <!-- End Form -->
                                
                            </div>
                        </div>
                    </div> <!-- End Row -->
                    
                </div>
            </div>

        </div>

    </div>
    
<?= $this->endSection(); ?>




