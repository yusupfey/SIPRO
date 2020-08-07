<!-- <h2 class="pb-3">Perumahan</h2> -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Perumahan</h6>
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
        <a href="<?= base_url() ?>Dashboard/AddPerum" class="badge badge-primary p-3 text-md mb-4"><i class="fa fa-plus"></i> Tambah data</a>
        <div class="table-responsive">
            <table class="table table-striped dataTables_processing" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID Perum</th>
                        <th>Perumahan</th>
                        <th>Cluster</th>
                        <th>Picture</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>ID Perum</th>
                        <th>Perumahan</th>
                        <th>Cluster</th>
                        <th>Picture</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $no =  1;
                    foreach ($db_perum as $f) :
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $f->id_perum; ?></td>
                            <td><?= $f->nm_perumahan; ?></td>
                            <td><?= $f->claster; ?></td>
                            <td><img src="<?= base_url() ?>assets/img/<?= $f->pic; ?>" width="60" height="50" alt=""></td>
                            <td>
                                <?php if ($f->keterangan == 1) : ?>
                                    <span class="badge badge-success">Sudah terjual</span>
                                <?php else : ?>

                                    <?php if ($f->status == 0) : ?>
                                        <span class="badge badge-danger">Belum diboking</span>
                                    <?php else : ?>
                                        <span class="badge badge-warning">Sudah diboking</span>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>
                            <td class="text-center">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="<?= base_url() ?>Dashboard/UpdatePerum/<?= $f->id_perum; ?>" class="btn btn-success btn-circle"><i class="fa fa-edit"></i></a>
                                    <a href="" class="btn btn-info btn-circle view" data-toggle="modal" data-target="#show-detail" id="" data="<?= $f->id_perum; ?>"><span class=" fa fa-info"></span></span></a>
                                    <a href="<?= base_url() ?>Dashboard/Deleteperum/<?= $f->id_perum; ?>" type="button" class="btn btn-danger btn-circle"><span class="fa fa-trash"></span>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- <script>
    function hapus(x) {
        var id = x;
        // alert(id);
        $.ajax({
            type: 'get',
            url: '<? //= base_url() 
                    ?>Act/DeleteRumah',
            data: {
                id: id
            },
            dataType: 'json',
            success: function(hasil) {
                $('#target').load('<? //= base_url() 
                                    ?>Home/showrumah')
            }
        });
    }
</script> -->
<script>
    $(document).ready(function() {
        $('.view').on('click', function() {
            var id = $(this).attr('data');
            $.ajax({
                type: 'post',
                url: '<?= base_url() ?>Home/detailperumahan/' + id,
                success: function(data) {
                    $('#target-detail').html(data);
                    $('#show-perum').modal("show");
                }
            });
        });


    });
</script>