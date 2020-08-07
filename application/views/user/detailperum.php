<div class="container bg-white" style="font-size:18px;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">
    <div class="row">
        <div class="col-md-6 pt-4 pb-5">
            <div class="card">
                <div class="col-md-12 text-center">
                    <img class="img-thumbnail" src="<?= base_url() ?>assets/img/<?= $perum['pic']; ?>" style="width:100%;height:400px" alt=" Card image cap">
                    <div class="col-md-12 p-3 bg-info shadow m-2 text-white">
                        <span class="font-weight-bold">Sales :</span><br>
                        <?= $perum['nama']; ?> -
                        <?= $perum['nm_perumahan']; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 pt-4 pl-4 pr-4 pb-4">
            <div class="row">
                <div class="col-md-12">
                    <label class="font-weight-bold">Ukuran Rumah :</label><br>
                    <i class="text-dark"><?= $perum['uk_rumah'] ?></i><br>
                    <label class="font-weight-bold">Cicilan Rumah :</label><br>
                    <i class="text-dark">Rp. <?= number_format($perum['cicilan']) ?></i><br>
                    <label class="font-weight-bold">Harga :</label><br>
                    <i class="text-dark">Rp. <?= number_format($perum['harga']) ?></i>
                    <br>
                    <b>Cluster:</b></br>
                    <?= $perum['claster']; ?>
                    <hr>
                    <label class="font-weight-bold">Type:</label><br>
                    <?= $perum['type']; ?><br>
                    <label class="font-weight-bold">Deskripsi:</label><br>
                    <?= $perum['deskripsi']; ?><br>
                    <label class="font-weight-bold">Alamat:</label><br>
                    <?= $perum['alamat']; ?>

                    <hr>
                </div>
            </div>
        </div>

    </div>

</div>