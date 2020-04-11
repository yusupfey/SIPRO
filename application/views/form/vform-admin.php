<div class="row">
    <div class="col-md-9 col-sm-12">
        <?= $form_open ?>
        <div class="card">
            <div class="card-header text-white bg-primary">
                <?= $title ?>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <?= $idperum; ?>
                </div>
                <div class="form-group">
                    <?= $id_user; ?>
                </div>
                <div class="form-group">
                    <?= @$id_perumahan; ?>
                </div>
                <div class="form-group">
                    <?= @$claster; ?>
                </div>
                <div class="form-group">
                    <?= $type; ?>
                    <span class="text-danger"><?= form_error('type') ?></span>
                </div>
                <div class="form-group">
                    <?= $ukrumah; ?>
                </div>
                <div class="form-group">
                    <?= $harga; ?>
                </div>
                <div class="form-group">
                    <?= $cicilan; ?>
                </div>
                <div class="form-group">
                    <label>Deskripsi</label>
                    <?= $desk; ?>
                </div>
                <label>Alamat</label>
                <div class="form-group">
                    <?= $alamat; ?>
                </div>

            </div>
        </div>

    </div>
    <div class="col-md-3">
        <div class="card">
            <div class="card-header text-white bg-primary">
                <?= $title ?>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <?= @$img; ?>
                </div>
                <div class="form-group">
                    <?= @$pic; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <hr>
            <?= $btn; ?>
        </div>
    </div>
    <?= $form_close ?>

</div>