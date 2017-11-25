<!-- /subnavbar -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
                <form id="edit-profile" class="form-horizontal" action="<?php echo site_url('beranda/caritahun');?>" method="post">
                  <div class="control-group" align="right">                                           
                    <div class="controls">
                      <div class="input-append">
                        <select name="tahun" class="form-control" id="tahun">
                          <option value=''>- Tahun -</option>
                          <?php foreach($tahun as $thn){
                            echo "<option value='".$thn->tahun."'>".$thn->tahun.'</option>';
                          } ?> 
                        </select>
                        <button class="btn btn-primary" type="submit" name='submit' value='submit'><i class="icon-search"></i> Cari</button>
                        </form>
                      </div>
                    </div>  <!-- /controls -->      
                  </div> <!-- /control-group -->   
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Tabel Jumlah Peserta <?php echo $tahunini; ?></h3>
            </div>
            <!-- /widget-header -->
        <!-- =============== Magic =============== -->
        <?php
          $tahun=$tahunini; 
          for ($i=1; $i < 10; $i++) { 
            $bln[$i]=$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` between '$tahun-0".$i."-01' and '$tahun-0".$i."-30' or `waktu_selesai` between '$tahun-0".$i."-01' and '$tahun-0".$i."-30';")->num_rows()+$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` < '$tahun-0".$i."-01' AND `waktu_selesai` > '$tahun-0".$i."-30' ")->num_rows();
          }
          for ($i=10; $i <= 12; $i++) { 
            $bln[$i]=$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` between '$tahun-".$i."-01' and '$tahun-".$i."-30' or `waktu_selesai` between '$tahun-".$i."-01' and '$tahun-".$i."-30';")->num_rows()+$this->db->query("SELECT * FROM `peserta` WHERE `waktu_mulai` < '$tahun-".$i."-01' AND `waktu_selesai` > '$tahun-".$i."-30' ")->num_rows();
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
                  <tr>
                    <td> Januari </td>
                    <td> <?php echo $bln[1]; ?> </td>
                    <td class="td-actions"><a href="<?php echo site_url('beranda/detail/'.$tahun.'/1/');?>" class="btn btn-mini btn-info"><i class="btn-icon-only icon-eye-open"> </i></a></td>
                  </tr>
                  <tr>
                    <td> Februari </td>
                    <td> <?php echo $bln[2]; ?> </td>
                    <td class="td-actions"><a href="<?php echo site_url('beranda/detail/'.$tahun.'/2/');?>" class="btn btn-mini btn-info"><i class="btn-icon-only icon-eye-open"> </i></a></td>
                  </tr>
                  <tr>
                    <td> Maret </td>
                    <td> <?php echo $bln[3]; ?> </td>
                    <td class="td-actions"><a href="<?php echo site_url('beranda/detail/'.$tahun.'/3/');?>" class="btn btn-mini btn-info"><i class="btn-icon-only icon-eye-open"> </i></a></td>
                  </tr>
                  <tr>
                    <td> April </td>
                    <td> <?php echo $bln[4]; ?> </td>
                    <td class="td-actions"><a href="<?php echo site_url('beranda/detail/'.$tahun.'/4/');?>" class="btn btn-mini btn-info"><i class="btn-icon-only icon-eye-open"> </i></a></td>
                  </tr>
                  <tr>
                    <td> Mei </td>
                    <td> <?php echo $bln[5]; ?> </td>
                    <td class="td-actions"><a href="<?php echo site_url('beranda/detail/'.$tahun.'/5/');?>" class="btn btn-mini btn-info"><i class="btn-icon-only icon-eye-open"> </i></a></td>
                  </tr>
                  <tr>
                    <td> Juni </td>
                    <td> <?php echo $bln[6]; ?> </td>
                    <td class="td-actions"><a href="<?php echo site_url('beranda/detail/'.$tahun.'/6/');?>" class="btn btn-mini btn-info"><i class="btn-icon-only icon-eye-open"> </i></a></td>
                  </tr>
                  <tr>
                    <td> Juli </td>
                    <td> <?php echo $bln[7]; ?> </td>
                    <td class="td-actions"><a href="<?php echo site_url('beranda/detail/'.$tahun.'/7/');?>" class="btn btn-mini btn-info"><i class="btn-icon-only icon-eye-open"> </i></a></td>
                  </tr>
                  <tr>
                    <td> Agustus </td>
                    <td> <?php echo $bln[8]; ?> </td>
                    <td class="td-actions"><a href="<?php echo site_url('beranda/detail/'.$tahun.'/8/');?>" class="btn btn-mini btn-info"><i class="btn-icon-only icon-eye-open"> </i></a></td>
                  </tr>
                  <tr>
                    <td> September </td>
                    <td> <?php echo $bln[9]; ?> </td>
                    <td class="td-actions"><a href="<?php echo site_url('beranda/detail/'.$tahun.'/9/');?>" class="btn btn-mini btn-info"><i class="btn-icon-only icon-eye-open"> </i></a></td>
                  </tr>
                  <tr>
                    <td> Oktober </td>
                    <td><?php echo $bln[10]; ?></td>
                    <td class="td-actions"><a href="<?php echo site_url('beranda/detail/'.$tahun.'/10/');?>" class="btn btn-mini btn-info"><i class="btn-icon-only icon-eye-open"> </i></a></td>
                  </tr>
                  <tr>
                    <td> November </td>
                    <td> <?php echo $bln[11]; ?> </td>
                    <td class="td-actions"><a href="<?php echo site_url('beranda/detail/'.$tahun.'/11/');?>" class="btn btn-mini btn-info"><i class="btn-icon-only icon-eye-open"> </i></a></td>
                  </tr>
                  <tr>
                    <td> Desember </td>
                    <td> <?php echo $bln[12]; ?> </td>
                    <td class="td-actions"><a href="<?php echo site_url('beranda/detail/'.$tahun.'/12/');?>" class="btn btn-mini btn-info"><i class="btn-icon-only icon-eye-open"> </i></a></td>
                  </tr>
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