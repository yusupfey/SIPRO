<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">DataTables </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <!-- <tr> -->
                    <th>#</th>
                    <th>ID User</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>No. Telephone</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Picture</th>
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
                        <th>Password</th>
                        <th>Picture</th>
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
                            <td><?= $f->password; ?></td>
                            <td><img src="<?= base_url() ?>pic/<?= $f->pic; ?>" width="60" alt=""></td>
                            <td>
                                <a href="" class="badge badge-success p-2 ml-2"><span class="fa fa-edit"></span></a>
                                <a href="" class="badge badge-info p-2 pl-3  ml-2"><span class="fa fa-info"></span></a>
                                <a href="" class="badge badge-danger p-2 ml-2"><span class="fa fa-trash"></span></a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>