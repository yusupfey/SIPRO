<div class="bg-gray-100 p-4 col-md-9 col-xs-12" style="margin-bottom:300px;">
    <div class="card">
        <div class=" box text-left " style="margin-top:-10px; border-radius:5px">
            <div class="card-header bg-primary text-gray-100">
                Booking perumahan
            </div>
            <div class="card-body">
                <form action="<?= base_url() ?>Act/buy" enctype="multipart/form-data" method="post">
                    <table class="table table-striped" width="100%">
                        <tr>
                            <th>#</th>
                            <th>Diboking</th>
                            <th>pic</th>
                            <th>Bookingan</th>
                            <th>Aksi</th>
                        </tr>
                        <?php $no = 1;
                        foreach ($bookcart as $v) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $v->nama; ?></td>
                                <td><img src="<?= base_url() ?>assets/img/<?= $v->pic; ?>" width="100" alt="" srcset=""></td>
                                <td>
                                    <p>
                                        <?php if ($v->kategori == 'perum') : ?>
                                            <span><b><?= $v->nm_perumahan; ?></b></span><br>
                                        <?php endif; ?>
                                        <span><b><?= $v->type; ?></b></span><br>
                                        <span><?= $v->claster; ?>- <?= $v->alamat; ?> <?= $v->alamat; ?></span><br>
                                    </p>
                                </td>
                                <td><a href="" class="badge badge-danger p-2">Batalkan Bokingkan</a></td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>