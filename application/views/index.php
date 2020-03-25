<!DOCTYPE html>
<html lang="en" id="home">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY_CV</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">


    <link href="<?= base_url() ?>assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url() ?>assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/style.css"> 
        -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/slick/slick.css" />
    <!-- // Add the new slick-theme.css if you want the default styling -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/slick/slick-theme.css" />

    <!-- <script src="assets/js/jquery.min.js"></script> -->
    <link rel="stylesheet" type="text/css" href="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.css">
    <style>
        .body {
            background: #f6f6f6;
        }

        .katalog {
            min-height: 140px;
            border: 1px solid red;
        }

        .jumbotron {
            background-image: url("<?= base_url(); ?>assets/pic/bg.jpg");
            /* background-size: cover; */
            /* background-attachment: fixed; */
            background-position: 0 -100px;
            color: #eaeaea;
            box-shadow: 1px 1px 10px rgb(0, 0, 0, 0, 5);
            position: relative;
        }

        .jumbotron h1 {
            text-shadow: 1px 1px 10px rgb(0, 0, 0, 0, 5);
        }

        .form-src {
            margin-top: 200px;
        }

        .nav-cust {
            min-height: 90px;
            font-size: 20px;
        }

        .jumbotron::after {
            content: '';
            display: block;
            width: 100%;
            height: 100%;
            bottom: 0px;
            position: absolute;
            background-image: linear-gradient(to top, rgba(20, 20, 20, 2), rgba(0, 0, 0, 0));
            margin-left: -18px;
            margin-right: 0px;
        }

        .display-4,
        .lead,
        .form-src {
            z-index: 1;
            position: relative;
        }

        .cari-panel {
            box-shadow: 0 3px 3px rgba(0, 0, 0.5);
            padding: 30px;
            border-radius: 12px;
            margin-top: -300px;
            position: relative;
        }

        .footer {
            min-height: 450px;
            background: #1B1B1B;
            padding-top: 50px;
            margin-top: -20px;
        }

        .cover {
            min-height: 250px;
            border-radius: 5px
        }

        @media (min-width: 992px) {
            .nav-hover {
                margin-left: 20px;
            }

            .nav-hover:hover {
                border-bottom: 4px solid blue;
            }

            .cari-panel {
                background-color: white;
                box-shadow: 0 3px 3px rgba(0, 0, 0.5);
                padding: 30px;
                border-radius: 12px;
                margin-top: -130px;
                position: relative;
            }

            .jumbotron::after {
                content: '';
                display: block;
                width: 100%;
                height: 100%;
                bottom: 0px;
                position: absolute;
                background-image: linear-gradient(to top, rgba(20, 20, 20, 2), rgba(0, 0, 0, 0));
                margin-left: -32px;
                margin-right: 0px;
            }

            .active {
                border-bottom: 4px solid blue;
            }

            .form-login {
                padding-top: -10px;
                z-index: 1;
                position: relative;

            }

            /* profil */
            .img-profil {
                border-radius: 100%;
                margin-top: -150px;
                background-color: white;
            }

            .cover {
                min-height: 350px;
                border-radius: 5px
            }
        }

        .form-login {
            padding-top: -10px;
            z-index: 1;
            position: relative;

        }

        /* slick */
        .main {
            font-family: Arial;
            display: block;
            margin: 0 auto;
        }

        h3 {
            background: #fff;
            color: #3498db;
            font-size: 36px;
            line-height: 100px;
            margin: 10px;
            padding: 2%;
            position: relative;
            text-align: center;
        }

        .slick h1 {
            background-color: blue;
            border: 1px solid red;
            color: #3498db;
            line-height: 100px;
            margin: 10px;
            padding: 2%;
            position: relative;
            text-align: center;
        }

        .slick-custom {
            position: relative;
            line-height: 100px;
        }


        /* !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! */
        /* input[type=text] {
            width: 100%;
            height: 40px;
            padding: 12px 10px;
            margin: 8px 0;
            box-sizing: border-box;
            border: 3px solid #ccc;
            -webkit-transition: 0.5s;
            transition: 0.5s;
            outline: none;
        }

        input[type=file] {
            border: 3px solid #3498db;
        }

        input[type=text]:focus {
            border: 3px solid #3498db;
        } */
        /* profil */
        .img-profil {
            border-radius: 100%;
            margin-top: -150px;
            background-color: white;
        }
    </style>

    <!-- <script src="<?= base_url() ?>assets/ckeditor/ckeditor.js"></script> -->
    <script src="<?= base_url() ?>assets/sweetalert/sweetalert.min.js"></script>
    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
</head>

<body class="body">
    <?= $header; ?>
    <?= @$sidebar; ?>
    <?= $content; ?>
    <?= @$foot; ?>
    <?= $footer; ?>




    <!-- end objective -->


    <script src="<?= base_url() ?>assets/js/bootstrap.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?= base_url() ?>assets/vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?= base_url() ?>assets/js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="<?= base_url() ?>assets/vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url() ?>assets/js/demo/chart-area-demo.js"></script>
    <script src="<?= base_url() ?>assets/js/demo/chart-pie-demo.js"></script>
    <script>
        // $('.page-scroll').on('click', function() {
        //     console.log("ok");
        // });
    </script>
    <!-- <script src="<?= base_url() ?>assets/js/myscript.js"></script> -->
    <script src="<?= base_url() ?>assets/vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?= base_url() ?>assets/vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="<?= base_url() ?>assets/js/demo/datatables-demo.js"></script>
    <!-- slick js -->
    <script type="text/javascript" src="<?= base_url() ?>assets/slick/slick.min.js"></script>
    <script>
        $('.slider-for').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
            fade: true,
            asNavFor: '.slider-nav'
        });
        $('.slider-nav').slick({
            slidesToShow: 3,
            slidesToScroll: 1,
            asNavFor: '.slider-for',
            dots: true,
            focusOnSelect: true
        });

        $('a[data-slide]').click(function(e) {
            e.preventDefault();
            var slideno = $(this).data('slide');
            $('.slider-nav').slick('slickGoTo', slideno - 1);
        });
    </script>
</body>

</html>