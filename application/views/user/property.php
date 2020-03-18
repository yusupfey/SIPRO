<div class="container-fluid">
    <!-- DataTales Example -->
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Data Rumah</h1>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rumah</h6>
        </div>
        <div class="card-body">
            <a href="" class="badge badge-primary p-3 text-md mb-4"><i class="fa fa-plus"></i> Tambah data</a>
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ID Rumah</th>
                            <th>Penjual</th>
                            <th>Deskripsi</th>
                            <th>Ukuran</th>
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
                            <th>Penjual</th>
                            <th>Deskripsi</th>
                            <th>Ukuran</th>
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
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $t->id_rumah; ?></td>
                                <td><?= $t->id_user; ?></td>
                                <td><?= $t->type; ?></td>
                                <td><?= $t->uk_rumah; ?></td>
                                <td><?= $t->harga; ?></td>
                                <td><img src="<?= base_url() ?>pic/<?= $t->pic; ?>" width="60" alt=""></td>
                                <td><span class="badge badge-success"><?= $t->status; ?></span></td>
                                <td><a href="" class="btn btn-success btn-circle"><i class="fa fa-edit"></i></a>
                                    <a href="" class="btn btn-info btn-circle"><span class=" fa fa-info"></span></a>
                                    <a href="" class="btn btn-danger btn-circle" p-2 ml-2"><span class="fa fa-trash"></span></a>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<script>
    // $(function() {

    //     ambildata();
    //     $('#dataTable').dataTable();

    //     function ambildata() {
    //         $.ajax({
    //             type: 'GET',
    //             url: '<?= base_url() ?>index.php/Administrator/getproperty',
    //             dataType: 'json',
    //             success: function(data) {
    //                 var cek = ''
    //                 var i
    //                 for (i = 0; i < data.length; i++) {
    //                     var no = i + 1
    //                     cek += '<tr>' +
    //                         '<td>' + no + '</td>' +
    //                         '<td>' + data[i].id_rumah + '</td>' +
    //                         '<td>' + data[i].id_user + '</td>' +
    //                         '<td>' + data[i].nama + '</td>' +
    //                         '<td>' + data[i].uk_rumah + '</td>' +
    //                         '<td>' + data[i].harga + '</td>' +
    //                         '<td>' + data[i].harga + '</td>' +
    //                         '<td>' + data[i].status + '</td>' +
    //                         '</tr>';
    //                 }
    //                 cek = ''
    //                 $('.table_target').html(cek);
    //             }
    //         });
    //     }
    // });
</script>