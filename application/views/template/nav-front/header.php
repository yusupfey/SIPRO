<nav class="navbar navbar-expand-lg navbar-light sticky-top bg-light nav-cust border-bottom-success">
    <div class="container">
        <a class="navbar-brand" href="#">
            <img src="<?= base_url() ?>assets/img/LOGOSIPRO.png" width="170" height="60">
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">

            </div>
            <div class="navbar-nav ml-auto">
                <a class="nav-item nav-link nav-hover active" href="<?= base_url() ?>">Home <span class="sr-only">(current)</span></a>
                <a class="nav-item nav-link nav-hover" href="#">About</a>
                <a class="nav-item nav-link nav-hover" href="<?= base_url() ?>Home/katalog">Katalog</a>
                <!-- Nav Item - Alerts -->
                <li class="nav-item dropdown no-arrow mx-1">
                    <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa fa-shopping-cart fa-fw"></i>
                        <!-- Counter - Alerts -->
                        <?php
                        if ($this->session->userdata('id_user') != "") :
                            foreach (@$cart as $p) :
                                if ($cart) : ?>
                                    <sup><span class="badge badge-danger badge-counter">
                                            <?php
                                            echo $p->booking;
                                            ?>
                                        </span></sup>
                        <?php endif;
                            endforeach;
                        endif; ?></a>
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
                        <a class="dropdown-item text-center small text-gray-500" href="<?= base_url() ?>Act/actBooking">Show All Alerts</a>
                    </div>
                </li>


                <?php if ($this->session->userdata('id_user')) : ?>
                    <div class="nav-item dropdown ml-5">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline large"><?= $this->session->userdata('username'); ?></span>
                            <img class="img-profile rounded-circle" src="">
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if ($this->session->userdata('id_akses') == 1 || $this->session->userdata('id_akses') == 3) : ?>
                                <a class="dropdown-item" href="<?= base_url() ?>Dashboard">Page Admin</a>
                            <?php else : ?>
                                <a class="dropdown-item" href="<?= base_url() ?>Home/profil">Profil</a>
                            <?php endif; ?>
                            <!-- <a class="dropdown-item" href="#"></a> -->
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="<?= base_url() ?>Act/Logout">Logout</a>
                        </div>
                    </div>
                <?php else : ?>
                    <a class="nav-item nav-link nav-hover" href="<?= base_url() ?>Login/formlogin">Login</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

</nav>