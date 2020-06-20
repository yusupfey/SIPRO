<div class=" card">
    <div class=" box text-left " style="margin-top:-10px; border-radius:5px">
        <div class="card-header bg-primary text-gray-100">
            Bookingan Saya
        </div>
        <div class="card-body">
            <form action="<?= base_url() ?>Act/buy" enctype="multipart/form-data" method="post">
                <table class="table table-striped" width="100%">
                    <tr>
                        <th>#</th>
                        <th>Pic</th>
                        <th>Bookingan</th>
                        <th>Hubungi</th>
                    </tr>
                    <?php $no = 1;
                    foreach ($bookcart as $v) : ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><img src="<?= base_url() ?>assets/img/<?= $v->pic; ?>" width="80" alt="" srcset=""></td>
                            <td>
                                <p>
                                    <span><b><?= $v->id_perum; ?></b></span><br>
                                    <span><b><?= $v->nama; ?></b></span><br>
                                    <span><?= $v->claster; ?></span>-
                                    <span><?= $v->type; ?></span>
                                    <span><?= $v->alamat; ?></span></p>
                            </td>
                            <td class="text-center"><a href="https://wa.me/<?= $v->notel; ?>"><img src="<?= base_url() ?>pic/wa.png" width="50px" alt="" srcset=""></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </form>
        </div>
    </div>
</div>