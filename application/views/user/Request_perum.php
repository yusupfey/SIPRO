<div class="col-md-9 col-xs-12">
    <?php if ($this->session->flashdata('true')) : ?>
        <script>
            swal({
                title: "Berhasil!",
                text: "Di Update!",
                icon: "success",
            });
        </script>
    <?php endif; ?>

    <h2>Request Jual Perumahan</h2>
    <hr>
    <div class="box border-bottom-success">
        <div class="card">
            <div class="card-header bg-primary text-gray-100">
                Paket Penjualan
            </div>
            <div class="card-body text-center">
                <div class="p-2 bg-gray-200">
                    <h2>RP. 300.000</h2>
                    <spa6>3 bulan</span>
                </div>
                <div class="p-2 bg-gray-100">
                    <h2>RP. 700.000</h2>
                    <span class="">7 bulan</span>
                </div>
                <div class="p-2 bg-gray-200">
                    <h2>RP. 1.000.000</h2>
                    <span class="">1 Tahun</span>
                </div>
            </div>
        </div>
    </div>
    <div class="box border-bottom-success">
        <div class="card">
            <div class="card-header bg-primary text-gray-100">
                Keunggulan Dan Keuntungan Mengunakan Fitur Jual Perumahan
            </div>
            <div class="card-body">
                <ol>
                    <li>Mendapatkan Kemudahan untuk membangun bisnis property</li>
                    <li>Nama perumahaannya di tampilkan di landing page</li>
                    <li>Membantu Mempromosikan perumahan anda</li>
                    <li>Booking Praktis</li>
                    <li>Langsung deal</li>
                </ol>
            </div>
        </div>
    </div>

    <div class="box text-left " style="min-height:600px; margin-top:-10px; border-radius:5px">
        <div class="card">
            <div class="card-header bg-primary text-gray-100">
                Form Request
            </div>
            <div class="card-body">
                <form action="<?= base_url() ?>Act/req" method="post">
                    <div class="form-group">
                        <?= $id; ?>
                        <i class="text-danger"><?= form_error('nama'); ?></i>
                    </div>
                    <div class="form-group">
                        <label>Nama</label>
                        <?= $nama; ?>
                        <i class="text-danger"><?= form_error('nama'); ?></i>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <?= $email; ?>
                        <i class="text-danger"><?= form_error('email'); ?></i>
                    </div>
                    <div class="form-group">
                        <label>Nama Perumahan</label>
                        <?= $perum; ?>
                    </div>
                    <div class="form-group">
                        <label>Pilih Paket</label>

                        <select name="paket" class="form-control" id="">
                            <option>--- Pilih Paket ---</option>
                            <option value="1">300rb/3 bulan</option>
                            <option value="2">700rb/7 bulan</option>
                            <option value="3">1jt/1 Tahun</option>
                        </select>
                        <i class="text-danger"><?= form_error('nama'); ?></i>
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success float-right">Request</button>
                    </div>
                </form>
            </div>
        </div>


        <!-- </div> -->
    </div>
</div>