<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">   
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Tabel Jumlah Peserta pada bulan <?php echo $bulanini; ?> tahun <?php echo $tahunini; ?></h3>
            </div>
            <!-- /widget-header -->
        <!-- =============== Magic =============== -->
        <?php
          $jumlahhari=cal_days_in_month(CAL_GREGORIAN, $bulanini, $tahunini);
          $tahun=$tahunini; 
          for ($i=1; $i <= $jumlahhari; $i++) {
            if ($bulanini<=9) {
              if ($i<=9) {
                  $tgl[$i]=$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` between '$tahun-0".$bulanini."-0".$i."' and '$tahun-0".$bulanini."-0".$i."' or `waktu_selesai` between '$tahun-0".$bulanini."-0".$i."' and '$tahun-0".$bulanini."-0".$i."';")->num_rows()+$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` < '$tahun-0".$bulanini."-0".$i."' AND `waktu_selesai` > '$tahun-0".$bulanini."-0".$i."' ")->num_rows();
               }else{
                 $tgl[$i]=$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` between '$tahun-0".$bulanini."-".$i."' and '$tahun-0".$bulanini."-".$i."' or `waktu_selesai` between '$tahun-0".$bulanini."-".$i."' and '$tahun-0".$bulanini."-".$i."';")->num_rows()+$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` < '$tahun-0".$bulanini."-".$i."' AND `waktu_selesai` > '$tahun-0".$bulanini."-".$i."' ")->num_rows();
               }
            }else{
              if ($i<=9) {
                  $tgl[$i]=$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` between '$tahun-".$bulanini."-0".$i."' and '$tahun-".$bulanini."-0".$i."' or `waktu_selesai` between '$tahun-".$bulanini."-0".$i."' and '$tahun-".$bulanini."-0".$i."';")->num_rows()+$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` < '$tahun-".$bulanini."-0".$i."' AND `waktu_selesai` > '$tahun-".$bulanini."-0".$i."' ")->num_rows();
               }else{
                 $tgl[$i]=$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` between '$tahun-".$bulanini."-".$i."' and '$tahun-".$bulanini."-".$i."' or `waktu_selesai` between '$tahun-".$bulanini."-".$i."' and '$tahun-".$bulanini."-".$i."';")->num_rows()+$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` < '$tahun-".$bulanini."-".$i."' AND `waktu_selesai` > '$tahun-".$bulanini."-".$i."' ")->num_rows();
               }
            }             
          }
         ?>
        <!-- ============================== -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Bulan </th>
                    <th> Jumlah</th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                  <?php for ($i=1; $i <= $jumlahhari; $i++) { ?>
                  <tr>
                    <td> <?php echo $i; ?> </td>
                    <td> <?php echo $tgl[$i]; ?> </td>
                    <td class="td-actions"><a href="<?php echo site_url('beranda/detail/'.$tahun.'/'.$bulanini.'/'.$i.'/');?>" class="btn btn-mini btn-info"><i class="btn-icon-only icon-eye-open"> </i></a></td>
                  </tr>
                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /widget-content --> 
          </div>
          <!-- /widget -->
        </div>
        <!-- /row -->
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->