<div class="container bg-white">
    <div class="row">
        <div class="col-md-8 pt-4 pl-4 pr-4 pb-4">
            <div class="row">
                <div class="col-md-12">
                    <img class="img-thumbnail" src="<?= base_url() ?>assets/img/<?= $rumah['pic']; ?>" width="100%" height="800" alt=" Card image cap">
                </div>
                <div class="col-md-12 p-3 bg-gray-300 shadow m-2">
                    <span class="font-weight-bold">Penjual</span><br>
                    <?= $rumah['id_user']; ?>
                </div>
                <div class="col-md-12 pt-4">
                    <b>Type:</b><br>
                    <?= $rumah['type']; ?>
                    <hr>
                    <b>deskripsi:</b><br>
                    <?= $rumah['deskripsi']; ?>
                    <hr>
                    <b>Alamat:</b><br>
                    <?= $rumah['alamat']; ?>
                    <hr>
                </div>
            </div>
        </div>
        <div class="col-md-4 pt-4 pb-5">
            <div class="card">
                <div class="card-header">
                    Booking
                </div>
                <div class="card-body">
                    <label>Ukuran Rumah :</label><br>
                    <i class="text-dark"><?= $rumah['uk_rumah'] ?></i><br>
                    <label>Harga :</label><br>
                    <i class="text-dark"><?= $rumah['harga'] ?></i>
                    <hr>
                    <?php if ($rumah['status'] == 1) : ?>
                        <a href="?>"><button class="btn-danger form-control">Sudah dibooking</button></a>
                    <?php else : ?>
                        <a href="<?= base_url() ?>Act/booking/<?= $perum['id_perumahan']; ?>"><button class="btn-success form-control">Booking</button></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

</div>