<!DOCTYPE html>
<html lang="en" id="home">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MY_CV</title>
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/bootstrap.min.css">



    <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>
    <!-- <link rel="stylesheet" type="text/css" href="assets/css/style.css"> 
        -->

    <!-- <script src="assets/js/jquery.min.js"></script> -->
    <style>
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

        @media (min-width: 992px) {
            .nav-link {
                margin-left: 20px;
            }

            .nav-link:hover {
                border-bottom: 4px solid blue;
            }

            .cari-panel {
                background-color: white;
                box-shadow: 0 3px 3px rgba(0, 0, 0.5);
                padding: 30px;
                border-radius: 12px;
                margin-top: -90px;
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
        }
    </style>

</head>

<body>