<nav class="navbar navbar-expand-lg navbar-light sticky-top bg-light nav-cust">
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
                <a class="nav-item nav-link nav-hover" href="<?= base_url() ?>">Kategori</a>
                <a class="nav-item nav-link nav-hover" href="<?= base_url() ?>">Disabled</a>
                <?php if ($this->session->userdata('id_user')) : ?>
                    <div class="nav-item dropdown ml-5">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?= $this->session->userdata('username') ?>
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if ($this->session->userdata('id_akses') == 1) : ?>
                                <a class="dropdown-item" href="<?= base_url() ?>Administrator">Page Admin</a>
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