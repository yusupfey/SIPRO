<div class="bg-gray-100 p-4 col-md-9 col-xs-12">
    <?php if ($this->session->flashdata('proses')) : ?>
        <script>
            swal({
                title: "Terimakasih!",
                text: "pengajuan anda sedang di proses!",
                icon: "success",
            });
        </script>
    <?php endif; ?>
    <div class="box border-bottom-success">
        <div class="card" style="height:550px;">
            <div class="card-header bg-primary text-gray-100">
                Proses Daftar
            </div>
            <div class="card-body text-center">
                <div class="p-5 bg-gray-200 mt-5">
                    <h2 class="text-info font-weight-bold">
                        <i>Registrasi pengajuan anda sedang di proses ! terimakasih :)</i>
                    </h2>
                    <h6 class="text-danger">
                        <i>**pastikan anda sudah mengupload data dengan benar dan sesuai<br>agar mempermudah proses konfirmasi akun anda</i>
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>