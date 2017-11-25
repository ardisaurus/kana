<!-- /subnavbar  -->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
      <?php if ($this->session->flashdata('warning')) {?>
            <div class="alert alert-danger">
              <button type="button" class="close" data-dismiss="alert">&times;</button>
              <?php echo $this->session->flashdata('warning');?>
            </div>
        <?php } ?>
        <?php if ($this->session->flashdata('message')) { ?>
            <div class="alert alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <?php echo $this->session->flashdata('message');?>
            </div>          
        <?php } ?>
        
        <div class="widget ">
              <div class="widget-header">
                <i class="icon-home"></i>
                <h3>Detail surat</h3>
            </div> <!-- /widget-header -->
          
          <div class="widget-content">
            <div class="control-group">
              <div class="controls">
                Nomor Surat Keluar : <?php echo $datasurat[0]->no_surat_keluar; ?>
              <a href="#modalubahnosuratkeluar" class="btn btn-mini btn-primary" data-toggle="modal" ><i class="icon-edit"></i> Ubah</a>
              </div> <!-- /controls -->
              <br>              
              <div id="modalubahnosuratkeluar" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalubahnosuratkeluartLabel" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalubahnosuratkeluarLabel">Ubah no surat keluar</h3>
                        </div>
                        <div class="modal-body">
                          <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('surat/ubahnosuratkeluar');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="id_surat" name="id_surat" value="<?php echo $datasurat[0]->id_surat; ?>">
                            </div>
                            <div class="control-group">                     
                            <label class="control-label" for="nosuratkeluar" >No Surat Keluar</label>
                            <div class="controls">
                              <input type="text" id="nosuratkeluar" name="nosuratkeluar" value="<?php echo $datasurat[0]->no_surat_keluar; ?>" >
                            </div>       
                          </div> <!-- /control-group -->      
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                            <button class="btn btn-warning">Ubah</button>
                            </form>
                          </div>
                        </div>
              <div class="controls">
              Tgl Surat Keluar : <?php echo $datasurat[0]->tgl_surat_keluar; ?> 
              <a href="#modalubahwaktuselesai" class="btn btn-mini btn-primary" data-toggle="modal" ><i class="icon-edit"></i> Ubah</a>
              <div id="modalubahwaktuselesai" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalubahwaktuselesaiLabel" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalubahwaktuselesaiLabel">Ubah Waktu Pelaksanaan</h3>
                        </div>
                        <div class="modal-body">
                          <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('surat/ubahtglkeluar');?>" method="post">
                          <div class="controls">
                              <input type="hidden" id="id_surat" name="id_surat" value="<?php echo $datasurat[0]->id_surat; ?>">
                            </div>
                           <div class="control-group">                      
                            <label class="control-label" for="radiobtns">Tanggal Selesai</label>                      
                            <div class="controls">
                              <select name="harikeluar" class="form-control">
                                <option value="0"> - Hari - </option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                              </select>
                              <select name="bulankeluar" class="form-control">
                                <option value="0"> - Bulan - </option>
                                <option value="1">Januari</option>
                                <option value="2">Febuari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Augustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                              </select>
                              <select name="tahunkeluar" class="form-control">
                                <option value="0"> - Tahun - </option>
                                <?php
                                  for ($i=6; $i >0 ; $i--) {  
                                    $x=365*$i;                             
                                    $oneYearOn = date('Y',strtotime(date("Y-m-d", mktime()) . " - $x day"));
                                    echo "<option value='".$oneYearOn."'>".$oneYearOn."</option>";
                                  } 
                                  for ($i=0; $i <6 ; $i++) {  
                                    $x=365*$i;                             
                                    $oneYearOn = date('Y',strtotime(date("Y-m-d", mktime()) . " + $x day"));
                                    echo "<option value='".$oneYearOn."'>".$oneYearOn."</option>";
                                  }
                                 ?>
                              </select>
                            </div>  <!-- /controls -->      
                          </div> <!-- /control-group -->       
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                            <button class="btn btn-warning">Ubah</button>
                            </form>
                          </div>
                        </div>             
              </div> <!-- /controls -->
              <br>
              <div class="controls">
                Kepada : <?php echo $datasurat[0]->kepada; ?>
              <a href="#modalubahkepada" class="btn btn-mini" data-toggle="modal" ><i class="icon-edit"></i> Ubah</a>
              </div> <!-- /controls -->
              <div id="modalubahkepada" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalubahkepada" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalubahkepada">Ubah kepada</h3>
                        </div>
                        <div class="modal-body">
                          <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('surat/ubahkepada');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="id_surat" name="id_surat" value="<?php echo $datasurat[0]->id_surat; ?>">
                            </div>
                            <div class="control-group">                     
                            <label class="control-label" for="kepada" >Kepada</label>
                            <div class="controls">
                              <input type="text" id="kepada" name="kepada" value="<?php echo $datasurat[0]->kepada; ?>" >
                            </div>       
                          </div> <!-- /control-group -->      
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                            <button class="btn btn-warning">Ubah</button>
                            </form>
                          </div>
                        </div>
              <br>
              <div class="controls">
                Nomor Surat Masuk : <?php echo $datasurat[0]->no_surat_masuk; ?>
              <a href="#modalubahnosuratmasuk" class="btn btn-mini btn-warning" data-toggle="modal" ><i class="icon-edit"></i> Ubah</a>
              </div> <!-- /controls -->
              <br>
              <div id="modalubahnosuratmasuk" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalubahnosuratmasukLabel" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalubahnosuratmasukLabel">Ubah surat</h3>
                        </div>
                        <div class="modal-body">
                          <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('surat/ubahnosuratmasuk');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="id_surat" name="id_surat" value="<?php echo $datasurat[0]->id_surat; ?>">
                            </div>
                            <div class="control-group">                     
                            <label class="control-label" for="nosuratmasuk" >No Surat Masuk</label>
                            <div class="controls">
                              <input type="text" id="nosuratmasuk" name="nosuratmasuk" value="<?php echo $datasurat[0]->no_surat_masuk; ?>" >
                            </div>       
                          </div> <!-- /control-group -->      
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                            <button class="btn btn-warning">Ubah</button>
                            </form>
                          </div>
                        </div>
                        <div class="controls">
              Tgl Surat Masuk : <?php echo $datasurat[0]->tgl_surat_masuk; ?>
              <a href="#modalubahwaktu" class="btn btn-mini btn-warning" data-toggle="modal" ><i class="icon-edit"></i> Ubah</a>
              <div id="modalubahwaktu" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalubahwaktuLabel" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalubahwaktuLabel">Ubah Waktu Pelaksanaan</h3>
                        </div>
                        <div class="modal-body">
                          <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('surat/ubahtglmasuk');?>" method="post">
                          <div class="controls">
                              <input type="hidden" id="id_surat" name="id_surat" value="<?php echo $datasurat[0]->id_surat; ?>">
                            </div>
                           <div class="control-group">                      
                            <label class="control-label" for="radiobtns">Tanggal Mulai</label>                      
                            <div class="controls">
                              <select name="harimasuk" class="form-control">
                                <option value="0"> - Hari - </option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                                <option value="11">11</option>
                                <option value="12">12</option>
                                <option value="13">13</option>
                                <option value="14">14</option>
                                <option value="15">15</option>
                                <option value="16">16</option>
                                <option value="17">17</option>
                                <option value="18">18</option>
                                <option value="19">19</option>
                                <option value="20">20</option>
                                <option value="21">21</option>
                                <option value="22">22</option>
                                <option value="23">23</option>
                                <option value="24">24</option>
                                <option value="25">25</option>
                                <option value="26">26</option>
                                <option value="27">27</option>
                                <option value="28">28</option>
                                <option value="29">29</option>
                                <option value="30">30</option>
                                <option value="31">31</option>
                              </select>
                              <select name="bulanmasuk" class="form-control">
                                <option value="0"> - Bulan - </option>
                                <option value="1">Januari</option>
                                <option value="2">Febuari</option>
                                <option value="3">Maret</option>
                                <option value="4">April</option>
                                <option value="5">Mei</option>
                                <option value="6">Juni</option>
                                <option value="7">Juli</option>
                                <option value="8">Augustus</option>
                                <option value="9">September</option>
                                <option value="10">Oktober</option>
                                <option value="11">November</option>
                                <option value="12">Desember</option>
                              </select>
                              <select name="tahunmasuk" class="form-control">
                                <option value="0"> - Tahun - </option>
                                <?php
                                  for ($i=6; $i >0 ; $i--) {  
                                    $x=365*$i;                             
                                    $oneYearOn = date('Y',strtotime(date("Y-m-d", mktime()) . " - $x day"));
                                    echo "<option value='".$oneYearOn."'>".$oneYearOn."</option>";
                                  } 
                                  for ($i=0; $i <6 ; $i++) {  
                                    $x=365*$i;                             
                                    $oneYearOn = date('Y',strtotime(date("Y-m-d", mktime()) . " + $x day"));
                                    echo "<option value='".$oneYearOn."'>".$oneYearOn."</option>";
                                  }
                                 ?>
                              </select>
                            </div>  <!-- /controls -->      
                          </div> <!-- /control-group -->      
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                            <button class="btn btn-warning">Ubah</button>
                            </form>
                          </div>
                        </div>
              </div> <!-- /controls -->
              <br>
            </div> <!-- /control-group -->
          </div> <!-- /widget-content -->

        </div> <!-- /widget -->
          <div class="widget ">
              
              <div class="widget-header">
                <i class="icon-user"></i>
                <h3>Peserta Pada Surat <?php echo $this->session->userdata('no_surat_keluar'); ?></h3>
            </div> <!-- /widget-header -->
          
          <div class="widget-content">
                       
                  <fieldset>
                    <?php 
                        $i=1;
                          if ($datapeserta) {                    
                              foreach ($datapeserta as $peserta) {
                     ?>
                    <div class="control-group">                     
                      <label class="control-label" for="no_surat_keluar" >Peserta <?php echo $i; ?> : <?php echo $peserta->nama_peserta; ?> <a href="#modalhapus<?php echo $peserta->idsuratpeserta; ?>" data-toggle="modal"><i class="icon-remove"></i></a></label>

                    <div id="modalhapus<?php echo $peserta->idsuratpeserta; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalhapusLabel<?php echo $peserta->idsuratpeserta; ?>" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalhapusLabel<?php echo $peserta->idsuratpeserta; ?>">Hapus peserta</h3>
                        </div>
                        <div class="modal-body">
                          <form id="hapus-admin" class="form-horizontal" action="<?php echo site_url('surat/hapuspesertaedit');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="idsuratpeserta" name="idsuratpeserta" value="<?php echo $peserta->idsuratpeserta; ?>">
                            </div>
                            <div class="controls">
                              Hapus peserta <strong><?php echo $peserta->nama_peserta; ?> dari daftar</strong>?
                            </div>                  
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                            <button class="btn btn-danger">Hapus</button>
                            </form>
                          </div>
                        </div>
                    </div> <!-- /control-group -->
                    <?php 
                        $i++;
                        }
                      }
                     ?>
                    <div class="control-group" align="center">                     
                      <?php if (count($datapeserta)<4) { ?>
                            <a href="<?php echo site_url('surat/listpesertaedit');?>" class="btn btn-success"> <i class="btn-icon-only icon-plus"> </i> Tambah</a>                          
                        <?php }  ?>       
                    </div> <!-- /control-group --> 
                  </fieldset>

          </div> <!-- /widget-content -->
            
        </div> <!-- /widget -->
        </div>
            <div align="right">
              <div class="controls">
              <!-- Button to trigger modal -->
                 <a href="<?php echo site_url('surat/cetak');?>" role="button" class="btn btn-primary"><i class="icon-print"></i> Cetak</a>
              </div>
            </div>
      <!-- /row -->
      </div>
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main