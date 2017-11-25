<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
            <?php 
                  $tgl=$tahunini."-".$bulanini."-".$hariini;
                  if ($datadivisi) {
             ?>
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Daftar peserta pada tanggal <?php echo $tgl; ?> </h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <tbody>
                  <?php 
                      foreach ($datadivisi as $divisi) {
                  ?>
                  <tr>
                    <td> <?php echo $divisi->nama; ?> </td>
                    <td> 
                    <?php
                        $i=$hariini;
                        $tahun=$tahunini;                       
                        if ($bulanini<=9) {
                          if ($i<=9) {
                              echo $this->db->query("SELECT * FROM `peserta` LEFT JOIN `divisi` ON `peserta`.`id_divisi` = `divisi`.`id_divisi` WHERE `waktu_mulai` between '$tahun-0".$bulanini."-0".$i."' and '$tahun-0".$bulanini."-0".$i."' or `waktu_selesai` between '$tahun-0".$bulanini."-0".$i."' and '$tahun-0".$bulanini."-0".$i."' AND `peserta`.`id_divisi`=$divisi->id_divisi;")->num_rows()+$this->db->query("SELECT * FROM `peserta` LEFT JOIN `divisi` ON `peserta`.`id_divisi` = `divisi`.`id_divisi` WHERE `waktu_mulai` < '$tahun-0".$bulanini."-0".$i."' AND `waktu_selesai` > '$tahun-0".$bulanini."-0".$i."' AND `peserta`.`id_divisi`=$divisi->id_divisi")->num_rows();
                           }else{
                             echo $this->db->query("SELECT * FROM `peserta` LEFT JOIN `divisi` ON `peserta`.`id_divisi` = `divisi`.`id_divisi` WHERE `waktu_mulai` between '$tahun-0".$bulanini."-".$i."' and '$tahun-0".$bulanini."-".$i."' or `waktu_selesai` between '$tahun-0".$bulanini."-".$i."' and '$tahun-0".$bulanini."-".$i."' AND `peserta`.`id_divisi`=$divisi->id_divisi;")->num_rows()+$this->db->query("SELECT * FROM `peserta` LEFT JOIN `divisi` ON `peserta`.`id_divisi` = `divisi`.`id_divisi` WHERE `waktu_mulai` < '$tahun-0".$bulanini."-".$i."' AND `waktu_selesai` > '$tahun-0".$bulanini."-".$i."'  AND `peserta`.`id_divisi`=$divisi->id_divisi")->num_rows();
                           }
                        }else{
                          if ($i<=9) {
                              echo $this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` between '$tahun-".$bulanini."-0".$i."' and '$tahun-".$bulanini."-0".$i."' or `waktu_selesai` between '$tahun-".$bulanini."-0".$i."' and '$tahun-".$bulanini."-0".$i."' AND `peserta`.`id_divisi`=$divisi->id_divisi;")->num_rows()+$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` < '$tahun-".$bulanini."-0".$i."' AND `waktu_selesai` > '$tahun-".$bulanini."-0".$i."'  AND `peserta`.`id_divisi`=$divisi->id_divisi")->num_rows();
                           }else{
                             echo $this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` between '$tahun-".$bulanini."-".$i."' and '$tahun-".$bulanini."-".$i."' or `waktu_selesai` between '$tahun-".$bulanini."-".$i."' and '$tahun-".$bulanini."-".$i."'  AND `peserta`.`id_divisi`=$divisi->id_divisi;")->num_rows()+$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` < '$tahun-".$bulanini."-".$i."' AND `waktu_selesai` > '$tahun-".$bulanini."-".$i."'  AND `peserta`.`id_divisi`=$divisi->id_divisi")->num_rows();
                           }
                        }       
                     ?>
                    </td>
                  </tr>
                  <?php 
                    }
                   ?>
                </tbody>
              </table>              
            </div>
            <!-- /widget-content --> 
          </div>
          <?php }else{ ?>
            <div class="alert alert-danger">
              Kosong
            </div>
          <?php } ?>
          <!-- /widget -->
        </div>
      <!-- /widget -->
      </div>
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->