<div class="container mb-5 mt-4">
    <div class="row mt-2">
        <div class="col-md-3 mb-4" id="wrapper">
            <div class="text-center border-left-success " style="height:350px;">
                <h5>Dashboard</h5>
                <hr>
                <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>Home/profil">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Profil</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>Home/Mybooking">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Bookingan saya</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-fw fa-home"></i>
                            <span>Jual Rumah</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="<?= base_url() ?>Home/rumah">Data Rumah</a>
                                <a class="collapse-item" href="<?= base_url() ?>Home/CekPenjualan">Booking</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= base_url() ?>Home/RequestPerum">
                            <i class="fas fa-fw fa-hotel"></i>
                            <span>Daptar Perumahan</span></a>
                    </li>
                </ul>
            </div>
        </div>