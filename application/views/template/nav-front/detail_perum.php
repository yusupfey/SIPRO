<div class="container bg-white" style="font-size:18px;font-family:Cambria, Cochin, Georgia, Times, 'Times New Roman', serif">
    <div class="row">
        <div class="col-md-8 pt-4 pl-4 pr-4 pb-4">
            <div class="row">
                <div class="col-md-12 text-center">
                    <img class="img-thumbnail" src="<?= base_url() ?>assets/img/<?= $perum['pic']; ?>" style="width:100%;height:400px" alt=" Card image cap">
                </div>
                <div class="col-md-12 p-3 bg-info shadow m-2 text-white rounded">
                    <span class="font-weight-bold">Sales :</span><br>
                    <?= $perum['nama']; ?> -
                    <?= $perum['nm_perumahan']; ?>
                </div>
                <div class="col-md-12 pt-4">
                    <b>Cluster:</b><br>
                    <?= $perum['claster']; ?>
                    <hr>
                    <b>Type:</b><br>
                    <?= $perum['type']; ?>
                    <hr>
                    <b>Deskripsi:</b><br>
                    <?= $perum['deskripsi']; ?>
                    <hr>
                    <b>Alamat:</b><br>
                    <?= $perum['alamat']; ?><br>
                    <a href="<?= $perum['titik_coridinat']; ?>" class="badge badge-primary" target="_blank" rel="noopener noreferrer">open via google maps</a>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-md-4 pt-4 pb-5">
            <div class="card">
                <div class="card-header">
                    Booking
                </div>
                <div class="card-body" style="font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif">
                    <label class="font-weight-bold">Ukuran Rumah :</label><br>
                    <i class="text-dark"><?= $perum['uk_rumah'] ?></i><br>
                    <hr class="divider">
                    <label class="font-weight-bold">Cicilan Rumah :</label><br>
                    <i class="text-dark">Rp. <?= number_formaT($perum['cicilan']) ?></i><br>
                    <hr class="divider">
                    <label class="font-weight-bold">Harga :</label><br>
                    <i class="text-dark">Rp. <?= number_format($perum['harga']) ?></i>
                    <hr>
                    <?php if ($perum['status'] == 1 and $perum['keterangan'] == 0) : ?>
                        <button class="btn-danger form-control" disabled>Sudah dibooking</button>
                    <?php elseif ($perum['status'] == 1 and $perum['keterangan'] == 1) : ?>
                        <button class="btn-secondary form-control" disabled>Sudah Terjual</button>
                    <?php else : ?>
                        <a href="<?= base_url() ?>Act/booking/<?= $perum['id_perum']; ?>"><button class="btn-success form-control">Booking</button></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>