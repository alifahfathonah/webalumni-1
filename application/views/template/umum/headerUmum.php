<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title><?= $title; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="<?= base_url('assets/back-end/vendor/bootstrap/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= base_url('assets/back-end/vendor/font-awesome/css/font-awesome.min.css') ?>" rel="stylesheet"
        type="text/css">
    <link
        href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800'
        rel='stylesheet' type='text/css'>
    <link
        href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic'
        rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="<?= base_url('assets/back-end/vendor/magnific-popup/magnific-popup.css') ?>" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="<?= base_url('assets/back-end/css/creative.min.css') ?>" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body id="page-top">

    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="<?= base_url('umum'); ?>">IKASMA3BDG</a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?= base_url('umum/berita'); ?>" class="page-scroll" href="">Berita</a></li>
                    <li><a href="<?= base_url('umum/forumbisnis'); ?>" class="page-scroll" href="">Forum Bisnis</a></li>
                    <li><a href="<?= base_url('umum/komunitas'); ?>" class="page-scroll" href="">Komunitas</a></li>
                    <li><a href="<?= base_url('umum/anggota'); ?>" class="page-scroll" href="">Anggota</a></li>
                    <li><a href="<?= base_url('umum/lowongan'); ?>" class="page-scroll" href="">Lowongan</a></li> 
                     
                    <li class="dropdown"  style="margin-right:20px">
                        <a href="" class="dropdown-toggle" data-toggle="dropdown"> 
                        <span class="navbar-avatar">
                            <img width="20" src="<?php echo base_url('uploads/avatars//' . $info[0]->nama_foto); ?>"
                                alt="<?= $info[0]->nama_lengkap; ?>" title="<?= $info[0]->nama_lengkap; ?>" />
                        </span>  <?= $info[0]->nama_lengkap; ?></a>
                        
                        <ul class="dropdown-menu">
                            <li><a href="<?= base_url('umum/pengaturan'); ?>">Pengaturan <span class="glyphicon glyphicon-cog pull-right">
                            <li><a href="<?= base_url('umum/profile'); ?>">Profil <span class="glyphicon glyphicon-stats pull-right"></span></a></li>
                            <li><a href="<?= base_url('Login/Logout'); ?>">Log Out <span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>
    