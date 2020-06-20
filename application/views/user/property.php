<!-- DataTales Example -->
<!-- Page Heading -->
<h1 class="h3 mb-2 text-gray-800">Data Rumah</h1>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Rumah</h6>
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
        <a href="<?= base_url() ?>Act/AddRumah" class="badge badge-primary p-3 text-md mb-4"><i class="fa fa-plus"></i> Tambah data</a>
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID Rumah</th>
                        <!-- <th>Penjual</th> -->
                        <th>Model</th>
                        <th>Harga</th>
                        <th>Pic</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>ID Rumah</th>
                        <!-- <th>Penjual</th> -->
                        <th>Model</th>
                        <th>Harga</th>
                        <th>Pic</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $no =  1;
                    foreach ($db_property as $t) :
                    ?>
                        <tr id="target">
                            <td><?= $no++; ?></td>
                            <td><?= $t->id_perum; ?></td>
                            <!-- <td><? //= $t->id_user; 
                                        ?></td> -->
                            <td><?= $t->type; ?></td>
                            <td><?= $t->harga; ?></td>
                            <td><img src="<?= base_url() ?>assets/img/<?= $t->pic; ?>" width="60" alt=""></td>
                            <td>
                                <?php if ($t->status and $t->keterangan == 0) : ?>
                                    <span class="badge badge-warning">
                                        Sudah diboking
                                    </span>
                                <?php elseif ($t->status == 1 and $t->keterangan == 1) : ?>
                                    <span class="badge badge-success">
                                        Sudah Terjual
                                    </span>
                                <?php else : ?>
                                    <span class="badge badge-danger">
                                        Belum diboking
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="<?= base_url() ?>Act/UpdateRumah/<?= $t->id_perum; ?>" type="button" class="btn btn-success btn-circle"><i class="fa fa-edit"></i></a>
                                    <a href="" type="button" class="btn btn-info btn-circle view" data-toggle="modal" data-target="#show-detail" data='<?= $t->id_perum; ?>'><i class=" fa fa-info"></i></a>
                                    <a href="<?= base_url() ?>Act/DeleteRumah/<?= $t->id_perum; ?>" type="button" id="delete" class="btn btn-danger btn-circle"><i class="fa fa-trash"></i></a>
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
                url: '<?= base_url() ?>Home/detailrumah/' + id,
                success: function(data) {
                    $('#target-detail').html(data);
                    $('#show-perum').modal("show");
                }
            });
        });


    });
</script>