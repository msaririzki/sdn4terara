<!DOCTYPE html>
<html lang="zxx">

<head>
  <meta charset="utf-8">
  <title>SD Negeri 4 Terara</title>  

  <!-- mobile responsive meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  
  <!-- ** Plugins Needed for the Project ** -->
  <!-- Bootstrap -->
  <link rel="stylesheet" href="<?=BASEURL?>/plugins/bootstrap/bootstrap.min.css">
  <!-- slick slider -->
  <link rel="stylesheet" href="<?=BASEURL?>/plugins/slick/slick.css">
  <!-- themefy-icon -->
  <link rel="stylesheet" href="<?=BASEURL?>/plugins/themify-icons/themify-icons.css">
  <!-- animation css -->
  <link rel="stylesheet" href="<?=BASEURL?>/plugins/animate/animate.css">
  <!-- aos -->
  <link rel="stylesheet" href="<?=BASEURL?>/plugins/aos/aos.css">
  <!-- venobox popup -->
  <link rel="stylesheet" href="<?=BASEURL?>/plugins/venobox/venobox.css">

  <!-- Main Stylesheet -->
  <link href="<?=BASEURL?>/css/style.css" rel="stylesheet">
  
  <!--Favicon-->
  <link rel="shortcut icon" href="<?=BASEURL?>/images/logo.svg" type="image/x-icon">
  <link rel="icon" href="<?=BASEURL?>/images/favicon.ico" type="image/x-icon">

</head>

<body>
  

<!-- header -->
<header class="fixed-top header">
  <!-- top header -->
  <div class="top-header py-2 bg-white">  
    <div class="container">
      <div class="row no-gutters">
        <div class="col-lg-4 text-center text-lg-left">
          <!-- add real number of this school for the contact -->
          <a class="text-color mr-3" href="#"><strong>CALL </strong> +62 (6272) 383 76</a>
          <ul class="list-inline d-inline">
            <!-- add real link to social media of this school -->
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-facebook"></i></a></li>
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-instagram"></i></a></li>
            <li class="list-inline-item mx-0"><a class="d-inline-block p-2 text-color" href="#"><i class="ti-youtube"></i></a></li> 
          </ul>
        </div>
        <div class="col-lg-8 text-center text-lg-right">
          <ul class="list-inline">
            <li class="list-inline-item"><a
                class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block"
                href="<?=BASEURL;?>/perpustakaan"
                >Perpustakaan</a
              >
            </li>
            <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="<?=BASEURL;?>/facility">Fasilitas</a></li> 
            <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="<?=BASEURL;?>/student">Data Siswa</a></li>
            <li class="list-inline-item"><a class="text-uppercase text-color p-sm-2 py-2 px-0 d-inline-block" href="#" data-toggle="modal" data-target="#loginModal">Login</a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>
  <!-- navbar -->
  <div class="navigation w-100">
    <div class="container">
      <nav class="navbar navbar-expand-lg navbar-light p-0">
        <a class="navbar-brand" href="<?= BASEURL; ?>"><img class="" src="<?=BASEURL;?>/images/logo-1.svg" alt="logo"></a>  

        <button class="navbar-toggler rounded-0" type="button" data-toggle="collapse" data-target="#navigation"
          aria-controls="navigation" aria-expanded="false" aria-label="Toggle navigation"> 
          <span class="navbar-toggler-icon"></span> 
        </button>

        <div class="collapse navbar-collapse" id="navigation">
          <ul class="navbar-nav ml-auto text-center">
            <li class="nav-item @@Beranda">
              <a class="nav-link @@Beranda" href="<?=BASEURL;?>">Beranda</a>
            </li>
            <li class="nav-item @@blog">
              <a class="nav-link" href="<?= BASEURL;?>/blog">Berita</a>
            </li>
            <li class="nav-item @@contact">
              <a class="nav-link" href="<?= BASEURL;?>/contact">Kontak</a> 
            </li>
            <li class="nav-item @@about">
              <a class="nav-link" href="<?=BASEURL;?>/about">Tentang Kami</a>
            </li>
          </ul>
        </div>
      </nav>
    </div>
  </div>
</header>
<!-- /header -->
<!-- Modal Pop Up -->
<!-- configurasi untuk proses login pada pop up ini -->
<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content rounded-0 border-0 p-4">
            <div class="modal-header border-0">
                <h3>Login</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- dibutuhkan configurasi untuk form input login -->
                <form action="<?=BASEURL;?>/login/authenticate" class="row" method="POST" enctype="multipart/form-data">
                    <div class="col-12">
                        <label for="username" class="col-form-label">Username</label> 
                        <input type="text" class="form-control mb-3" id="username" name="username" placeholder="Enter your username" required>
                    </div>
                    <div class="col-12">
                        <label for="password" class="col-form-label">Password</label>  
                        <input type="password" class="form-control mb-3" id="password" name="password" placeholder="Enter your password" required> 
                    </div>
                    <div class="col-12">
                        <!-- dibutuhkan configurasi credential user -->
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
