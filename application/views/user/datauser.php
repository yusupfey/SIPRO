<h2 class="pb-3">Data Pengguna</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pengguna</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ID User</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. Telephone</th>
                        <th>Email</th>
                        <th>Picture</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>ID User</th>
                        <th>Nama</th>
                        <th>Alamat</th>
                        <th>No. Telephone</th>
                        <th>Email</th>
                        <th>Picture</th>
                        <th>status</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php
                    $no =  1;
                    foreach ($db_user as $f) :
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $f->id_user; ?></td>
                            <td><?= $f->nama; ?></td>
                            <td><?= $f->alamat; ?></td>
                            <td><?= $f->notel; ?></td>
                            <td><?= $f->email; ?></td>
                            <td><img src="<?= base_url() ?>pic/<?= $f->pic; ?>" width="60" alt=""></td>
                            <td>
                                <a href="" class="btn btn-success btn-circle"><i class="fa fa-edit"></i></a>
                                <a href="" class="btn btn-info btn-circle"><span class=" fa fa-info"></span></span></a>
                                <a href="" class="btn btn-danger btn-circle" p-2 ml-2"><span class="fa fa-trash"></span>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>