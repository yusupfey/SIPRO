<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 p-5">
            <h4>Perumahan</h4>
            <hr class="divider">
            <div class="row text-center pb-5">
                <?php foreach ($perumahan as $p) :
                ?>
                    <div class="col-md-2">
                        <div class="card">
                            <img class="card-img-top" src="<?= base_url() ?>assets/img-perumahan/<?= $p->pic; ?>" style="height:180px" alt=" Card image cap">
                            <div class="card-body">
                                <div class="card-text"><?= $p->nm_perumahan; ?></div>
                                <hr>
                                <table class="table table-striped">
                                    <tr>
                                        <td>Cluster</td>
                                        <td>:</td>
                                        <td>
                                            <div class="card-text"><?= $p->claster ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Type</td>
                                        <td>:</td>
                                        <td>
                                            <div class="card-text"><?= $p->type ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td>
                                            <div class="card-title">Rp.<?= $p->harga ?></div>
                                        </td>
                                    </tr>
                                </table>
                                <a href="<?= base_url() ?>Home/detail_perumahan/<?= $p->id_perum ?>" class="float-right large"> <i>More info</i><span class="fa fa-fw fa-angle-right"></span></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
                ?>
            </div>
            <hr class="divider">
            <h4>Rumah</h4>
            <hr class="divider">
            <div class="row text-center pb-5">
                <?php foreach ($db_property as $v) :
                ?>
                    <div class="col-md-2">
                        <div class="card">
                            <img class="card-img-top" src="<?= base_url() ?>pic/<?= $v->pic; ?>" style="height:180px" alt=" Card image cap">
                            <div class="card-body">
                                <table class="table table-striped">
                                    <tr>
                                        <td>Cluster</td>
                                        <td>:</td>
                                        <td>
                                            <div class="card-text"><?= $v->type ?></div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Harga</td>
                                        <td>:</td>
                                        <td>
                                            <div class="card-title">Rp.<?= $v->harga ?></d>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <p class="card-text"><?= $v->status ?></p>

                                        </td>
                                    </tr>
                                </table>
                                <a href="<?= base_url() ?>Home/detail/<?= $v->id_rumah ?>" class="float-right large"> <i>More info</i><span class="fa fa-fw fa-angle-right"></span></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach;
                ?>
            </div>
        </div>
    </div>
</div>