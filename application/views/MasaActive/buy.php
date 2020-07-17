<div class="container">
    <?php if ($this->session->flashdata('true')) : ?>
        <script>
            swal({
                title: "Berhasil!",
                text: "Di Update!",
                icon: "success",
            });
        </script>
    <?php endif; ?>
    <div class="box border-bottom-success">
        <div class="card">
            <div class="card-header bg-primary text-gray-100">
                Transfer via
            </div>
            <div class="card-body text-center">
                <div class="p-2 bg-gray-200">
                    <h5>1111-1212-1231-12-1234</h5>
                    <h6>BRI A/n : Global Sipro</h6>
                </div>
                <div class="p-2 bg-gray-100">
                    <h5>0012-01231-2222-1223-21</h5>
                    <h6>BNI A/n : Global Sipro</h5>
                </div>
                <div class="p-2 bg-gray-200">
                    <h5>1211-0123-22222-12-1-23</h5>
                    <h6>Mandiri A/n : Global Sipro</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="card">
        <div class=" box text-left " style="margin-top:-10px; border-radius:5px">
            <div class="card-header bg-primary text-gray-100">
                Kirim Bukti pembayaran
            </div>
            <div class="card-body">
                <form action="<?= base_url() ?>MasaActive/buy" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <?= $upload; ?>
                        <i class="text-danger"><?= form_error('nama'); ?></i>
                    </div>
                    <hr>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success float-right">Kirim</button>
                    </div><br>
                </form>
            </div>
        </div>

        <!-- </div> -->
    </div>
</div>