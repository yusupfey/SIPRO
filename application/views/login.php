<div class="container-pluid jumbotron mb-0">
    <div class="row">
        <div class="col-lg-7 d-lg-block d-none">
            <h1 style="font-family: 'Open Sans', sans-serif;" class="display-4">SIPRO</h1>
            <h4 style="font-family: 'Open Sans', sans-serif;  color:white;position:relative; z-index:1;">Membantu Menemukan Rumah Impian Saya.</h4>
        </div>
        <div class="col-lg-5 col-md-12 col-xs-12 pl-5">
            <div class="card border-0" style="background-color: rgba(255, 255, 255, 0.5);">
                <div class="card-body">
                    <h1 style="font-family: 'Open Sans', sans-serif;" class="display-4"><b>LOG IN</b></h1>
                    <?= $this->session->flashdata('error'); ?>
                    <hr class="line">
                    <form action="<?= base_url() ?>index.php/Login" method="post" class="form-login user">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" class="form-control text-bold" style="background-color: rgba(255, 255, 255, 0.5); border:none; color:black; font-weight: bold">
                            <span class="text-danger"><?= form_error('username'); ?></span>
                        </div>
                        <div class="form-group">
                            <label for="username">Password</label>
                            <input type="Password" name="password" class="form-control" id="exampleInputEmail" aria-describedby="emailHelp" style="background-color: rgba(255, 255, 255, 0.5); border:none; color:black">
                            <span class="text-danger"><?= form_error('password'); ?></span>
                        </div>
                        <hr>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-block">
                                Login
                            </button>
                        </div>
                    </form>
                    <div class="text-center" style="color:white;position:relative; z-index:1;"><a href="<?= base_url() ?>Login/register" class="">Create an Account</a></div>
                </div>
            </div>
        </div>
    </div>
</div>