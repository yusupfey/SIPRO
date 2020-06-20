<nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark nav-cust">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">
            <img src="<?= base_url() ?>assets/img/LOGOSIPRO.png" width="170" height="60">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-white" id="navbarNavAltMarkup">
            <div class="navbar-nav">

            </div>
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link nav-hover active" href="<?= base_url() ?>">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link nav-hover" href="<?= base_url() ?>Home/About">About</a>
                <a class="nav-item nav-link nav-hover" href="<?= base_url() ?>Home/katalog">Katalog</a>
                <!-- Nav Item - Alerts -->
                <?php if ($this->session->userdata('id_user') != "") : ?>
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa fa-shopping-cart fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <?php

                            foreach (@$cart as $p) :
                                if ($cart) : ?>
                                    <sup>
                                        <span class="badge badge-danger badge-counter">
                                            <?php
                                            echo $p->booking;
                                            ?>
                                        </span>
                                    </sup>
                            <?php endif;
                            endforeach;
                            ?></a>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Bokingan
                            </h6>
                            <?php foreach ($bookcart as $v) : ?>
                                <a class="dropdown-item d-flex align-items-center" href="<?= base_url() ?>Act/actBooking">
                                    <div class="mr-3">
                                        <img src="<?= base_url() ?>pic/default.jpg" class="" width="50" style=" height:50px;border-radius:100%;" alt="" srcset="">
                                    </div>
                                    <div>
                                        <div class="small text-gray-500"><?= $v->tgl; ?></div>
                                        <p><?= $v->type; ?></p>

                                    </div>
                                </a>
                            <?php endforeach; ?>
                            <hr class="divide-header">
                            <a class="dropdown-item text-center small text-gray-500" href="<?= base_url() ?>Act/actBooking">Show All Bokingan</a>
                        </div>
                    </li>
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <?php foreach ($notif as $p) :
                                if ($notif) : ?>
                                    <sup><span class="badge badge-danger badge-counter">
                                            <?php
                                            echo $p->jml;

                                            ?>
                                        </span></sup>
                            <?php endif;
                            endforeach;
                            ?>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <?php foreach ($notification as $v) : ?>
                                <a class="dropdown-item d-flex align-items-center" href="<?= base_url() ?>Home/notification">
                                    <div class="mr-3">
                                        <div class="icon-circle 
                                            <?php if ($v->icon == 'fa-donate') {
                                                echo 'bg-warning';
                                            } else if ($v->icon == 'fa fa-ban') {
                                                echo 'bg-danger';
                                            } else {
                                                echo 'bg-success';
                                            } ?>">
                                            <i class="fas fa-fw <?= $v->icon; ?> text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500"><?= $v->tgl; ?> - From : <?= $v->id_user; ?></div>
                                        <?= $v->requerst; ?>

                                    </div>
                                </a>
                            <?php endforeach; ?>
                            <a class="dropdown-item text-center small text-gray-500" href="<?= base_url() ?>Home/notification">Show All Alerts</a>
                        </div>
                    </li>

                <?php endif; ?>
                <?php if ($this->session->userdata('id_user')) : ?>
                    <div class="nav-item dropdown ml-5">
                        <div class="btn-group mt-1">
                            <button class="btn btn-success btn-md" type="button">
                                <span class="mr-2 d-none d-lg-inline large"><?= $this->session->userdata('username'); ?></span>
                                <img class="img-profile rounded-circle" src="">
                            </button>
                            <button type="button" class="btn btn-sm btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="sr-only">Toggle Dropdown</span>
                            </button>
                            <div class="dropdown-menu">
                                <?php if ($this->session->userdata('id_akses') == 1 || $this->session->userdata('id_akses') == 3) : ?>
                                    <a class="dropdown-item" href="<?= base_url() ?>Dashboard">Page Admin</a>
                                <?php else : ?>
                                    <a class="dropdown-item" href="<?= base_url() ?>Home/Profil">
                                        <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                        Profile
                                    </a>
                                <?php endif; ?>
                                <!-- <a class="dropdown-item" href="#"></a> -->
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </div>
                    </div>
                <?php else : ?>
                    <a class="nav-item nav-link nav-hover" href="<?= base_url() ?>Login/formlogin">Login</a>
                <?php endif; ?>

            </div>
        </div>
    </div>

</nav>