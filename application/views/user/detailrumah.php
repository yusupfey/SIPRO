<div class="container bg-white" style="font-size:18px;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">
    <div class="row">
        <div class="col-md-6 pt-4 pb-5">
            <div class="card">
                <div class="col-md-12 text-center">
                    <img class="img-thumbnail" src="<?= base_url() ?>assets/img/<?= $perum['pic']; ?>" style="width:100%;height:400px" alt=" Card image cap">
                </div>
            </div>
        </div>
        <div class="col-md-6 pt-4 pl-4 pr-4 pb-4">
            <div class="row">
                <div class="col-md-12 p-3 bg-info shadow m-2 text-white">
                    <span class="font-weight-bold">Sales :</span><br>
                    <?= $perum['nama']; ?>
                </div>
                <div class="col-md-12 pt-4">
                    <label class="font-weight-bold">Ukuran Rumah : </label><br>
                    <i class="text-dark"><?= $perum['uk_rumah'] ?></i><br>
                    <label class="font-weight-bold">Cicilan Rumah : </label><br>
                    <i class="text-dark"><?= $perum['cicilan'] ?></i><br>
                    <label class="font-weight-bold">Harga : </label><br>
                    <i class="text-dark"><?= $perum['harga'] ?></i>
                    <hr>
                    <label class="font-weight-bold">Jenis : </label><br>
                    <?= $perum['type']; ?><br>
                    <label class="font-weight-bold">Deskripsi : </label><br>
                    <?= $perum['deskripsi']; ?><br>
                    <label class="font-weight-bold">Alamat : </label><br>
                    <?= $perum['alamat']; ?>
                    <hr>
                </div>
            </div>
        </div>
    </div>
</div>