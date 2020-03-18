<div class="container mb-5 mt-4">
    <div class="row mt-2">
        <div class="col-md-3 mb-4" id="wrapper">
            <div class="box text-center border-left-success" style="height:250px;">
                <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Profil</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="fas fa-fw fa-tachometer-alt"></i>
                            <span>Booking</span></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-fw fa-home"></i>
                            <span>Jual Rumah</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="buttons.html">Data Rumah</a>
                                <a class="collapse-item" href="cards.html">Booking</a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.html">
                            <i class="fas fa-fw fa-hotel"></i>
                            <span>Daptar Perumahan</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9 col-xs-12">
            <div class="box border-bottom-success bg-success cover">
            </div>
            <div class="row text-center">
                <div class="col-md-12 mt-5">
                    <img src="<?= base_url() ?>assets/img/LOGOSIPRO.png" class="border-left-info img-profil" width="160" height="180" alt="">
                </div>
            </div>
            <!-- </div> -->
            <div class="box text-left pl-3 pr-3 pt-5 border-left-success" style="min-height:600px; margin-top:-70px; background-color:#f9f9f9; border-radius:5px">
                <?php if ($this->session->flashdata('true')) : ?>
                    <script>
                        swal({
                            title: "Berhasil!",
                            text: "Di Update!",
                            icon: "success",
                        });
                    </script>
                <?php endif; ?>
                <h2>Profil</h2>
                <hr>
                <form action="<?= base_url() ?>Act/Editprofil" method="post">
                    <?php foreach ($user as $v) :
                    ?>
                        <div class="form-group">
                            <label>Nama</label>
                            <input type="text" name="nama" value="<?= $v->nama; ?>" class="form-control">
                            <i class="text-danger"><?= form_error('nama'); ?></i>
                        </div>
                        <div class="form-group">
                            <label>No Telphone</label>
                            <input type="text" name="notel" value="<?= $v->notel; ?>" class="form-control">
                            <i class="text-danger"><?= form_error('notel'); ?></i>

                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" value="<?= $v->email; ?>" class="form-control">
                            <i class="text-danger"><?= form_error('email'); ?></i>

                        </div>
                        <div class="form-group">
                            <label>Alamat</label>
                            <textarea class="form-control " name="alamat"><?= $v->alamat; ?></textarea>
                            <i class="text-danger"><?= form_error('alamat'); ?></i>

                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success float-right">Edit Profil</button>
                        </div>
                    <?php endforeach;
                    ?>
                </form>
            </div>
        </div>
        <!-- <div class="col-md-3">
            <div class=" card">
                <div class="card-header">Jual Rumah</div>
                <div class="card-body">

                </div>
            </div>
        </div> -->
    </div>
</div>