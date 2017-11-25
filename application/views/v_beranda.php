<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Beranda - Sistem Manjemen Peserta PKL</title>
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
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <div class="span6">
          <div class="widget">
            <div class="widget-header"> <i class="icon-bookmark"></i>
              <h3>Manajemen Peserta</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="shortcuts"> 
                <a href="<?php echo site_url('pesertasekolah');?>" class="shortcut"><i class="shortcut-icon icon-bookmark" style="color:#3C3"></i><span class="shortcut-label">Sekolah</span> </a>
                <a href="<?php echo site_url('pesertapt');?>" class="shortcut"><i class="shortcut-icon icon-bookmark" style="color:#3366cc;"></i><span class="shortcut-label">Perguruan Tinggi</span> </a>
                <a href="<?php echo site_url('surat');?>" class="shortcut"><i class="shortcut-icon icon-envelope"></i><span class="shortcut-label">Persuratan</span> </a> 
              </div>
              <!-- /shortcuts --> 
            </div>
            <!-- /widget-content -->
          </div>
          <!-- /widget -->
          <!-- /widget -->
          <div class="widget">
            <div class="widget-header"> <i class="icon-file"></i>
              <h3> Grafik Peserta</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <canvas id="area-chart" class="chart-holder" height="250" width="538"> </canvas>
              <!-- /area-chart --> 
            </div>
            <!-- /widget-content --> 

          </div>
          <!-- /widget -->          
        </div>
        <!-- /span6 -->
        <!-- =============== Magic =============== -->
        <?php
          $tahun=date("Y"); 
          for ($i=1; $i < 10; $i++) { 
            $bln[$i]=$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` between '$tahun-0".$i."-01' and '$tahun-0".$i."-30' or `waktu_selesai` between '$tahun-0".$i."-01' and '$tahun-0".$i."-30';")->num_rows()+$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` < '$tahun-0".$i."-01' AND `waktu_selesai` > '$tahun-0".$i."-30' ")->num_rows();
          }
          for ($i=10; $i <= 12; $i++) { 
            $bln[$i]=$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` between '$tahun-".$i."-01' and '$tahun-".$i."-30' or `waktu_selesai` between '$tahun-".$i."-01' and '$tahun-".$i."-30';")->num_rows()+$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` < '$tahun-".$i."-01' AND `waktu_selesai` > '$tahun-".$i."-30' ")->num_rows();
          }
         ?>
        <!-- ============================== -->
        <div class="span6">
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-file"></i>
              <h3>Tabel Jumlah Peserta</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Bulan </th>
                    <th> Jumlah</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td> Januari </td>
                    <td> <?php echo $bln[1]; ?> </td>
                  </tr>
                  <tr>
                    <td> Februari </td>
                    <td> <?php echo $bln[2]; ?> </td>
                  </tr>
                  <tr>
                    <td> Maret </td>
                    <td> <?php echo $bln[3]; ?> </td>
                  </tr>
                  <tr>
                    <td> April </td>
                    <td> <?php echo $bln[4]; ?> </td>
                  </tr>
                  <tr>
                    <td> Mei </td>
                    <td> <?php echo $bln[5]; ?> </td>
                  </tr>
                  <tr>
                    <td> Juni </td>
                    <td> <?php echo $bln[6]; ?> </td>
                  </tr>
                  <tr>
                    <td> Juli </td>
                    <td> <?php echo $bln[7]; ?> </td>
                  </tr>
                  <tr>
                    <td> Agustus </td>
                    <td> <?php echo $bln[8]; ?> </td>
                  </tr>
                  <tr>
                    <td> September </td>
                    <td> <?php echo $bln[9]; ?> </td>
                  </tr>
                  <tr>
                    <td> Oktober </td>
                    <td><?php echo $bln[10]; ?></td>
                  </tr>
                  <tr>
                    <td> November </td>
                    <td> <?php echo $bln[11]; ?> </td>
                  </tr>
                  <tr>
                    <td> Desember </td>
                    <td> <?php echo $bln[12]; ?> </td>
                  </tr>
                </tbody>
              </table>
              <div class="form-actions" align="center">
                <a href="<?php echo site_url('beranda/detail');?>" class="btn btn-info"><i class="icon-eye-open"></i><span class="shortcut-label"> Detail</span> </a>                 
              </div>
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget -->
        </div> 
      </div>
      <!-- /row --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->
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
<script src="<?php echo base_url('assets/js/jquery-1.7.2.min.js'); ?>"></script> 
<script src="<?php echo base_url('assets/js/excanvas.min.js'); ?>"></script> 
<script src="<?php echo base_url('assets/js/chart.min.js'); ?>" type="text/javascript"></script> 
<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
<script language="javascript" type="text/javascript" src="<?php echo base_url('assets/js/full-calendar/fullcalendar.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/js/base.js'); ?>"></script> 
<script>     

        var lineChartData = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Agt", "Sep", "Okt", "Nov", "Des" ],
            datasets: [
        {
            fillColor: "rgba(151,187,205,0.5)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            data: [ <?php echo $bln[1]; ?>, 
                    <?php echo $bln[2]; ?>, 
                    <?php echo $bln[3]; ?>, 
                    <?php echo $bln[4]; ?>, 
                    <?php echo $bln[5]; ?>, 
                    <?php echo $bln[6]; ?>, 
                    <?php echo $bln[7]; ?>, 
                    <?php echo $bln[8]; ?>, 
                    <?php echo $bln[9]; ?>, 
                    <?php echo $bln[10]; ?>, 
                    <?php echo $bln[11]; ?>, 
                    <?php echo $bln[12]; ?> ]
        }
      ]

        }

        var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData);  

        $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var calendar = $('#calendar').fullCalendar({
          header: {
            left: '',
            center: 'title',
            right: ''
          },
          selectHelper: true,
          select: function(start, end, allDay) {
            var title = prompt('Event Title:');
            if (title) {
              calendar.fullCalendar('renderEvent',
                {
                  title: title,
                  start: start,
                  end: end,
                  allDay: allDay
                },
                true // make the event "stick"
              );
            }
            calendar.fullCalendar('unselect');
          },
          events: [
            {
              title: 'All Day Event',
              start: new Date(y, m, 1)
            },
            {
              title: 'Long Event',
              start: new Date(y, m, d+5),
              end: new Date(y, m, d+7)
            },
            {
              id: 999,
              title: 'Repeating Event',
              start: new Date(y, m, d-3, 16, 0),
              allDay: false
            },
            {
              id: 999,
              title: 'Repeating Event',
              start: new Date(y, m, d+4, 16, 0),
              allDay: false
            },
            {
              title: 'Meeting',
              start: new Date(y, m, d, 10, 30),
              allDay: false
            },
            {
              title: 'Lunch',
              start: new Date(y, m, d, 12, 0),
              end: new Date(y, m, d, 14, 0),
              allDay: false
            },
            {
              title: 'Birthday Party',
              start: new Date(y, m, d+1, 19, 0),
              end: new Date(y, m, d+1, 22, 30),
              allDay: false
            },
            {
              title: 'EGrappler.com',
              start: new Date(y, m, 28),
              end: new Date(y, m, 29),
              url: 'http://EGrappler.com/'
            }
          ]
        });
      });
    </script><!-- /Calendar -->
</body>
</html>
