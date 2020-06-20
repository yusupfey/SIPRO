<div class="card">
    <div class=" box text-left " style="margin-top:-10px; border-radius:5px">
        <div class="card-header bg-primary text-gray-100">
            Booking perumahan
        </div>
        <div class="card-body">
            <?php if ($this->session->flashdata('true')) : ?>
                <script>
                    swal({
                        title: "Berhasil!",
                        text: "<?= $this->session->flashdata('true') ?>",
                        icon: "<?= $this->session->flashdata('alert') ?>",
                    });
                </script>
            <?php endif; ?>
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
                    foreach ($databook as $v) : ?>
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
                                    <?php if ($v->kategori == 'perum') : ?>
                                        <span><?= $v->claster; ?>-</span>
                                    <?php endif; ?>
                                    <?= $v->alamat; ?><br>
                                </p>
                            </td>
                            <td>
                                <div class="btn btn-group">
                                    <a href="<?= base_url() ?>Act/batalboking/<?= $v->id_perum; ?>" class="btn btn-danger">Batalkan Bokingan</a>
                                    <a href="<?= base_url() ?>Act/terjual/<?= $v->id ?>" class="btn btn-success" style="font-size:14px;">Berhasil Terjual</a>

                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </form>
        </div>
    </div>
</div>