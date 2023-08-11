<!-- sidebar -->
<?php if (logged_in() == 1) { ?>
    <div class="sidebar px-4 py-4 py-md-4 me-0">
        <div class="d-flex flex-column h-100">
            <!-- Menu: main ul -->
            <ul class="menu-list flex-grow-1 mt-3">
                <span><img src="<?= base_url() ?>mystyle/fiesta.jpg" width="200px"></span><br>

                <?php if (in_groups('user')) : ?>
                    <li><a class="m-link <?php if ($title == 'Dashboard') {
                                                echo 'active';
                                            } ?>" href="<?= base_url() ?>">
                            <i class="icofont-home fs-5"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li><a class="m-link <?php if ($title == 'Keranjang Belanja') {
                                                echo 'active';
                                            } ?>" href="<?= base_url() ?>keranjang">
                            <i class="icofont-shopping-cart fs-5"></i>
                            <span>Keranjang belanja</span>
                        </a>
                    </li>
                    <li><a class="m-link <?php if ($title == 'Orders') {
                                                echo 'active';
                                            } ?>" href="<?= base_url() ?>orders">
                            <i class="icofont-page fs-5"></i>
                            <span>Orders</span>
                        </a>
                    </li>
                    <li><a class="m-link <?php if ($title == 'Tentang Kami') {
                                                echo 'active';
                                            } ?>" href="<?= base_url() ?>tentang-kami">
                            <i class="icofont-ui-contact-list fs-5"></i>
                            <span>Tentang Kami</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (in_groups('admin')) : ?>
                    <li><a class="m-link <?php if ($title == 'Dashboard') {
                                                echo 'active';
                                            } ?>" href="<?= base_url() ?>admin">
                            <i class="icofont-home fs-5"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php if (in_groups('admin')) : ?>
                    <li><a class="m-link <?php if ($title == 'Produk list') {
                                                echo 'active';
                                            } ?>" href="<?= base_url() ?>admin/products_list">
                            <i class="icofont-prestashop fs-5"></i>
                            <span>Products</span>
                        </a>
                    </li>

                    <li><a class="m-link <?php if ($title == 'Orders list') {
                                                echo 'active';
                                            } ?>" href="<?= base_url() ?>admin/orders_list">
                            <i class="icofont-listine-dots fs-5"></i>
                            <span>Orders List</span>
                        </a>
                    </li>

                    <li><a class="m-link <?php if ($title == 'laporan') {
                                                echo 'active';
                                            } ?>" href="<?= base_url() ?>admin/laporan">
                            <i class="icofont-listine-dots fs-5"></i>
                            <span>Laporan</span>
                        </a>
                    </li>

                    <li><a class="m-link <?php if ($title == 'Tentang Kami') {
                                                echo 'active';
                                            } ?>" href="<?= base_url() ?>admin/tentang-kami">
                            <i class="icofont-ui-contact-list"></i>
                            <span>Tentang Kami</span>
                        </a>
                    </li>
                <?php endif; ?>


            </ul>
            <!-- Menu: menu collepce btn -->
            <button type="button" class="btn btn-link sidebar-mini-btn text-light">
                <span class="ms-2"><i class="icofont-bubble-right"></i></span>
            </button>
        </div>
    </div>
<?php } ?>

<!-- main body area -->
<div class="main px-lg-4 px-md-4">

    <!-- Body: Header -->
    <div class="header">
        <nav class="navbar py-4">
            <div class="container-xxl">

                <!-- header rightbar icon -->
                <div class="h-right d-flex align-items-center mr-5 mr-lg-0 order-1">


                    <?php if (logged_in() == 1) { ?>
                        <div class="dropdown notifications">
                            <a class="nav-link dropdown-toggle pulse" href="#" role="button" data-bs-toggle="dropdown">
                                <i class="icofont-alarm fs-5"></i>
                                <span class="pulse-ring"></span>
                            </a>
                            <div id="NotificationsDiv" class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-md-end p-0 m-0 mt-3">
                                <div class="card border-0 w380">
                                    <div class="card-header border-0 p-3">
                                        <h5 class="mb-0 font-weight-light d-flex justify-content-between">
                                            <span>Notifications</span>
                                            <span class="badge text-white">1</span>
                                        </h5>
                                    </div>
                                    <div class="tab-content card-body">
                                        <div class="tab-pane fade show active">
                                            <ul class="list-unstyled list mb-0">
                                                <li class="py-2 mb-1 border-bottom">
                                                    <a href="javascript:void(0);" class="d-flex">
                                                        <img class="avatar rounded-circle" src="<?= base_url() ?>mystyle/assets/images/xs/avatar1.svg" alt="">
                                                        <div class="flex-fill ms-2">
                                                            <p class="d-flex justify-content-between mb-0 "><span class="font-weight-bold">FIESTA INFO</span></p>
                                                            <span class="">Selamat bergabung</span>
                                                        </div>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <a class="card-footer text-center border-top-0" href="#"> View all
                                        notifications</a>
                                </div>
                            </div>
                        </div>

                        <div class="dropdown user-profile ml-2 ml-sm-3 d-flex align-items-center zindex-popover">
                            <div class="u-info me-2">
                                <p class="mb-0 text-end line-height-sm "><span class="font-weight-bold"><?= user()->username ?></span></p>
                                <small><?= user()->email ?></small>
                            </div>
                            <a class="nav-link dropdown-toggle pulse p-0" href="#" role="button" data-bs-toggle="dropdown" data-bs-display="static">
                                <img class="avatar lg rounded-circle img-thumbnail" src="<?= base_url() ?>mystyle/assets/images/profile_av.svg" alt="profile">
                            </a>
                            <div class="dropdown-menu rounded-lg shadow border-0 dropdown-animation dropdown-menu-end p-0 m-0">
                                <div class="card border-0 w280">
                                    <div class="card-body pb-0">
                                        <div class="d-flex py-1">
                                            <img class="avatar rounded-circle" src="<?= base_url() ?>mystyle/assets/images/profile_av.svg" alt="profile">
                                            <div class="flex-fill ms-3">
                                                <p class="mb-0"><span class="font-weight-bold"><?= user()->username ?></span></p>
                                                <small class=""><?= user()->email ?></small>
                                            </div>
                                        </div>

                                        <div>
                                            <hr class="dropdown-divider border-dark">
                                        </div>
                                    </div>
                                    <div class="list-group m-2 ">
                                        <!-- <a href="<?= base_url() ?>data_pembeli" class="list-group-item list-group-item-action border-0 "><i class="icofont-ui-settings fs-5 me-3"></i>Settings alamat</a> -->

                                        <a href="<?= base_url() ?>logout" class="list-group-item list-group-item-action border-0 "><i class="icofont-logout fs-5 me-3"></i>Signout</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                    <?php } else { ?>
                        <a href="<?= base_url() ?>login" class="btn btn-primary"> Login </a>&nbsp;
                        <a href="<?= base_url() ?>login" class="btn btn-primary"> register </a>
                    <?php } ?>
                </div>

                <!-- menu toggler -->
                <button class="navbar-toggler p-0 border-0 menu-toggle order-3" type="button" data-bs-toggle="collapse" data-bs-target="#mainHeader">
                    <span class="fa fa-bars"></span>
                </button>

                <!-- main menu Search-->
                <div class="order-0 col-lg-4 col-md-4 col-sm-12 col-12 mb-3 mb-md-0 ">
                    <div class="input-group flex-nowrap input-group-lg">
                        <H4>Welcome to "CORNER FIESTA"</H4>
                    </div>
                </div>

            </div>
        </nav>
    </div>