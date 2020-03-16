<div class="container-pluid jumbotron">
    <div class="row">
        <div class="col-lg-7 d-lg-block d-none">
            <h1 class="display-4">SIPRO</h1>
            <h4 style="color:white;position:relative; z-index:1;">Membantu Anda Menemukan Rumah impian anda.</h4>
        </div>
        <div class="col-lg-5 col-md-12 col-xs-12 pl-5">
            <h1 class="display-4">LOGIN IN HERE</h1>
            <?= $this->session->flashdata('error'); ?>
            <hr class="line">
            <form action="<?= base_url() ?>index.php/Act" method="post" class="form-login user">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control form-control-user" placeholder="Enter Email Address...">
                    <span class="text-danger"><?= form_error('username'); ?></span>
                </div>
                <div class="form-group">
                    <label for="username">Password</label>
                    <input type="Password" name="password" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Enter Email Address...">
                    <span class="text-danger"><?= form_error('password'); ?></span>
                </div>
                <hr>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-user btn-block">
                        Login
                    </button>
                </div>
            </form>
            <div class="text-center" style="color:white;position:relative; z-index:1;"><a href="<?= base_url() ?>Login/register" class="">Create an Account</a></div>
        </div>
    </div>
</div>