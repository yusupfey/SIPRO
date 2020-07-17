<h2 class="pb-3">Data Pengguna</h2>
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Pengguna</h6>
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
        <?php endif ?>
        <a href="<?= base_url() ?>pengguna/createUser" class="badge badge-primary p-3 text-md mb-4"><i class="fa fa-plus"></i> Tambah data</a>
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
                            <td><img src="<?= base_url() ?>assets/profil/<?= $f->pic; ?>" width="60" alt=""></td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a href="<?= base_url() ?>pengguna/UpdateUser/<?= $f->id_user ?>" class="btn btn-success btn-circle"><i class="fa fa-edit"></i></a>
                                    <!-- <a href="" class="btn btn-info btn-circle"><span class=" fa fa-info"></span></span></a> -->
                                    <a href="<?= base_url() ?>pengguna/Delete/<?= $f->id_user ?>" class="btn btn-danger btn-circle"><span class="fa fa-trash"></span></a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>