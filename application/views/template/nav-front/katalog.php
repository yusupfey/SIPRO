<div class="container">
    <div id="tabs" class="mb-5 mt-5">
        <ul>
            <li><a href="#tabs-1">Perumahan</a></li>
            <li><a href="#tabs-2">Rumah</a></li>
        </ul>
        <div id="tabs-1">
            <div class="row">
                <div class="col-md-12 p-5">
                    <h4>Perumahan</h4>
                    <hr class="divider">
                    <div class="row pb-5">
                        <?php foreach ($perumahan as $p) :
                        ?>
                            <div class="col-lg-3 mt-4 col-md-6 col-sm-12 col-xs-12">
                                <div class="card">
                                    <img class="card-img-top" src="<?= base_url() ?>assets/img/<?= $p->pic; ?>" style="height:180px" alt=" Card image cap">
                                    <div class="card-body">
                                        <div class="card-text"><?= $p->nm_perumahan; ?></div>
                                        <hr>
                                        <label class="font-weight-bold">Cluster :</label>
                                        <div class="card-text bg-gray-100 p-2"><?= $p->claster ?></div>
                                        <label class="font-weight-bold">Harga :</label>
                                        <div class="card-title bg-gray-100 p-2">Rp.<?= $p->harga ?></div>

                                        <a href=" <?= base_url() ?>Home/detail_perumahan/<?= $p->id_perum ?>" class="float-right text-primary large"> <i>More info</i><span class="fa fa-fw fa-angle-right"></span></a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <div id="tabs-2">
            <h4>Rumah</h4>
            <hr class="divider">
            <div class="row pb-5">
                <?php foreach ($db_property as $v) :
                ?>
                    <div class="col-lg-3  mt-4 col-md-4 col-sm-12 col-xs-12">
                        <div class="card">
                            <img class="card-img-top" src="<?= base_url() ?>assets/img/<?= $v->pic; ?>" style="height:180px" alt=" Card image cap">
                            <div class="card-body">
                                <label class="font-weight-bold">Model :</label>
                                <div class="card-text bg-gray-100 p-2"><?= $v->type ?></div>
                                <label class="font-weight-bold">Harga :</label>
                                <div class="card-title bg-gray-100 p-2">Rp.<?= $v->harga ?></div>
                                <a href="<?= base_url() ?>Home/detail/<?= $v->id_perum ?>" class="float-right large text-primary"> <i>More info</i><span class="fa fa-fw fa-angle-right"></span></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
                ?>
            </div>
        </div>
    </div>
</div>
</div>