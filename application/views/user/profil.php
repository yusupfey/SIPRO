<div class="container p-5">
    <div class="row">
        <div class="col-md-3" id="wrapper">
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
                            <i class="fas fa-fw fa-cog"></i>
                            <span>Jual Rumah</span>
                        </a>
                        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                <a class="collapse-item" href="buttons.html">Data Rumah</a>
                                <a class="collapse-item" href="cards.html">Booking</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-9 col-xs-9">
            <div class="box border-left-success bg-info " style="height:250px; border-radius:20px">

            </div>
            <!-- <div class="boxt " style="height:150px; background-color:#f2f2f2"> -->
            <div class="row text-center">
                <div class="col-md-12">
                    <img src="<?= base_url() ?>assets/img/LOGOSIPRO.png" class="border-left-info " style="border-radius: 100%; margin-top:-90px; background-color:white" width="160" height="160" alt="">
                </div>
            </div>
            <!-- </div> -->
            <div class="box text-left pl-3 pr-3 pt-5 border-left-success" style="min-height:600px; background-color:#f6f6f6; margin-top:-65px; border-radius:20px">
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
                            <textarea class="form-control" name="alamat"><?= $v->alamat; ?></textarea>
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
    </div>
</div>