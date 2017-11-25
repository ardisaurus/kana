<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title><?php echo $title; ?> - Sistem Manjemen Peserta PKL</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes"> 
<link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.ico'); ?>">    
<link href="<?php echo site_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/bootstrap-responsive.min.css'); ?>" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url('assets/css/font-awesome.css'); ?>" rel="stylesheet"> 
<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/sticky-footer.css'); ?>" rel="stylesheet" type="text/css">
<link href="<?php echo base_url('assets/css/pages/dashboard.css'); ?>" rel="stylesheet" type="text/css">
</head>
<body>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"><a class="brand" href="index.html">Sistem Manjemen Peserta PKL </a>
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li><a href="<?php echo site_url('beranda');?>"><i class="icon-home"></i><span>Beranda</span> </a> </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-book"></i><span>Pendidikan</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('sekolah');?>">Sekolah</a></li>
            <li><a href="<?php echo site_url('pt');?>">Perguruan Tinggi</a></li>
          </ul>
        </li>
        <li><a href="<?php echo site_url('divisi');?>"><i class="icon-sitemap"></i><span>Divisi</span> </a> </li>
        <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-cog"></i><span>Pengaturan</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="<?php echo site_url('admin');?>">Daftar Admin</a></li>
            <li><a href="<?php echo site_url('akun');?>">Akun</a></li>
            <li><a href="<?php echo site_url('akun/logout');?>">Keluar</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>
  <!-- =============================================== -->

  <?php $this->load->view($page) ?>

  <!-- =============================================== -->
<div class="footer">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> &copy; 2017 <a href="<?php echo site_url('tentang');?>">PT Telekominukasi Indonesia, Tbk.</a> </div>
        <!-- /span12 --> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /footer-inner --> 
</div>
<!-- /footer --> 
<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
  <script src="<?php echo $path; ?>/jquery.min.js"></script>   
<script>
        $(document).ready(function(){
            $("#provinsi").change(function (){
                var url = "<?php echo site_url('sekolah/add_ajax_kab');?>/"+$(this).val();
                $('#kabupaten').load(url);
                return false;
            })
        });
    </script>
    <script>
        $(document).ready(function(){
            $("#lembaga").change(function (){
                var url = "<?php echo site_url('pesertapt/add_ajax_jurusan');?>/"+$(this).val();
                $('#jurusan').load(url);
                return false;
            })
        });
    </script>
    <script>
        $(document).ready(function(){
            $("#divisi").change(function (){
                var url = "<?php echo site_url('pesertapt/add_ajax_pembimbing');?>/"+$(this).val();
                $('#pembimbing').load(url);
                return false;
            })
        });
    </script>
<script src="<?php echo base_url('assets/js/jquery-1.7.2.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/excanvas.min.js'); ?>"></script> 
<script src="<?php echo base_url('assets/js/chart.min.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script> 
<script src="<?php echo base_url('assets/js/base.js'); ?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url('assets/js/full-calendar/fullcalendar.min.js'); ?>"></script>
</body>
</html>
