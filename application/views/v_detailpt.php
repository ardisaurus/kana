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
                <h3>Detail Lembaga Pendidikan</h3>
            </div> <!-- /widget-header -->
          
          <div class="widget-content">
            <div class="control-group">
              <div class="controls">
              Nama : <?php echo $datalembaga[0]->nama; ?>
              </div> <!-- /controls -->
              <br>
              <div class="controls">
              <?php echo $datalembaga[0]->alamat.", ".$datalembaga[0]->nama_kota.", ".$datalembaga[0]->nama_provinsi; ?>
              </div> <!-- /controls -->
              <div align="right">
                <div class="controls">
                <!-- Button to trigger modal -->
                  <a href="#modalubah" role="button" class="btn btn-warning" data-toggle="modal"><i class="icon-cog"></i> Ubah</a>                                
                </div> <!-- /controls -->
              </div>
            </div> <!-- /control-group -->
          </div> <!-- /widget-content -->            
        </div> <!-- /widget -->
        <div id="modalubah" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalubahLabel" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalubahLabel<?php echo $datalembaga[0]->id_lembaga; ?>">Ubah Lembaga Pendidikan</h3>
                        </div>
                        <div class="modal-body">
                          <form id="ubah-lembaga" class="form-horizontal" action="<?php echo site_url('pt/ubahlembaga');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="id_lembaga" name="id_lembaga" value="<?php echo $datalembaga[0]->id_lembaga; ?>">
                            </div>
                            <label class="control-label" for="nama">Nama</label>
                            <div class="controls">
                              <input type="text" id="nama" name="nama" value="<?php echo $datalembaga[0]->nama; ?>">
                            </div>
                            <br>
                            <div class="control-group">                     
                            <label class="control-label" for="radiobtns">Provinsi </label>
                              <div class="controls">
                                <div class="input-append">
                                  <input class="span2 m-wrap" id="appendedInputButton" type="text" disabled value="<?php echo $datalembaga[0]->nama_provinsi; ?>">
                                  <button class="btn btn-warning" type="button" data-dismiss="modal" data-toggle="modal" data-target="#modalkota">Ubah</button>
                                </div>
                              </div>  <!-- /controls -->      
                            </div> <!-- /control-group -->
                            <br>
                            <div class="control-group">                     
                            <label class="control-label" for="radiobtns">Kota </label>
                              <div class="controls">
                                <div class="input-append">
                                  <input class="span2 m-wrap" id="appendedInputButton" type="text" disabled value="<?php echo $datalembaga[0]->nama_kota; ?>">
                                  <button class="btn btn-warning" type="button" type="button" data-dismiss="modal" data-toggle="modal" data-target="#modalkota">Ubah</button>
                                </div>
                              </div>  <!-- /controls -->      
                            </div> <!-- /control-group -->
                            <br> 
                            <label class="control-label" for="alamat">Alamat</label>
                            <div class="controls">
                              <textarea name="alamat" id="alamat"><?php echo $datalembaga[0]->alamat; ?></textarea>
                            </div>                
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                            <button class="btn btn-primary">Ubah</button>
                            </form>
                          </div>
                        </div>
                        <div id="modalkota" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalkotaLabel" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalhkotaLabel">Ubah Provinsi dan Kabupaten</h3>
                        </div>
                        <div class="modal-body">
                          <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('pt/ubahkota');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="id_lembaga" name="id_lembaga" value="<?php echo $datalembaga[0]->id_lembaga; ?>">
                            </div>
                            <label for="provinsi" class="col-sm-3 control-label">Propinsi</label>
                            <div class="controls">
                              <select name="propinsi" class="form-control" id="provinsi">
                                <option>- Select Provinsi -</option>
                                <?php foreach($provinsi as $prov){
                                  echo '<option value="'.$prov->id.'">'.$prov->nama.'</option>';
                                } ?>
                              </select>
                            </div>
                            <br>
                            <label for="kota" class="col-sm-3 control-label">Kabupaten/Kota</label>
                              <div class="controls">
                                <select name="kota" class="form-control" id="kabupaten">
                                  <option value=''>Select Kabupaten</option>
                                </select>
                              </div>                  
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                            <button class="btn btn-warning">Ubah</button>
                            </form>
                          </div>
                        </div> 
        <?php 
          if ($datajurusan) {
        ?>
         
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3>Daftar Fakultas/Jurusan <?php echo $datalembaga[0]->nama; ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped">
                <tbody>
                  <?php 
                      foreach ($datajurusan as $jurusan) {
                  ?>
                  <tr>
                    <td> <?php if ($jurusan->jenis==0) {
                                echo "Jurusan ";
                              }else{
                                echo "Fakultas ";
                              }  
                              echo $jurusan->nama; ?> </td>
                    <td> 
                      <div align="right"> 
                        <a href="#modalubah<?php echo $jurusan->id_jurusan; ?>" role="button" class="btn-small btn-warning" data-toggle="modal"><i class="icon-cog"></i> Ubah</a>
                        <a href="#modalhapus<?php echo $jurusan->id_jurusan; ?>" role="button" class="btn-small btn-danger" data-toggle="modal"><i class="icon-remove"></i> Hapus</a>                          
                      </div>
                      <div id="modalubah<?php echo $jurusan->id_jurusan; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalubahLabel<?php echo $jurusan->id_jurusan; ?>" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalubahLabel<?php echo $jurusan->id_jurusan; ?>">Ubah jurusan</h3>
                        </div>
                        <div class="modal-body">
                          <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('pt/ubahjurusan');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="id_lembaga" name="id_lembaga" value="<?php echo $jurusan->id_lembaga; ?>">
                              <input type="hidden" id="id_jurusan" name="id_jurusan" value="<?php echo $jurusan->id_jurusan; ?>">
                            </div>
                            <label class="control-label" for="nama">Nama</label>
                            <div class="controls">
                              <input type="text" id="nama" name="nama" value="<?php echo $jurusan->nama; ?>">
                            </div>                
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                            <button class="btn btn-primary">Ubah</button>
                            </form>
                          </div>
                        </div>
                      <div id="modalhapus<?php echo $jurusan->id_jurusan; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalhapusLabel<?php echo $jurusan->id_jurusan; ?>" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalhapusLabel<?php echo $jurusan->id_jurusan; ?>">Hapus jurusan</h3>
                        </div>
                        <div class="modal-body">
                          <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('pt/hapusjurusan');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="id_jurusan" name="id_jurusan" value="<?php echo $jurusan->id_jurusan; ?>">
                            </div>
                            <div class="controls">
                              <input type="hidden" id="id_lembaga" name="id_lembaga" value="<?php echo $jurusan->id_lembaga; ?>">
                            </div>
                            <div class="controls">
                              Hapus jurusan <strong><?php echo $jurusan->nama; ?></strong>?
                            </div>                  
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                            <button class="btn btn-danger">Hapus</button>
                            </form>
                          </div>
                        </div>
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
          <!-- /widget -->
          <?php }else{ ?>
            <div class="alert alert-danger">
              Data Jurusan pada <strong><?php echo $datalembaga[0]->nama; ?></strong> kosong
            </div>
          <?php } ?>
            <div align="right">
              <div class="controls">
              <!-- Button to trigger modal -->
                 <a href="#modaltambah" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-plus"></i> Tambah</a>          
              </div>
              <?php if ($datajurusan) { ?>
              <div class="clearfix text-center">
                  <ul class="pagination pagination-md no-margin">
                      <?php
                          echo $this->pagination->create_links();
                      ?>
                  </ul>
              </div>
              <?php 
                  }
               ?>
              <!-- /controls -->
            </div>
            <div id="modaltambah" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modaltambahLabel" aria-hidden="true">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  <h3 id="modaltambahLabel">Tambah jurusan</h3>
              </div>
              <div class="modal-body">
                <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('pt/tambahjurusan');?>" method="post">
                  <label class="control-label" for="nama">Nama</label>
                  <div class="controls">
                    <input type="text" id="nama" name="nama">                    
                    <input type="hidden" id="id_lembaga" name="id_lembaga" value="<?php echo $datalembaga[0]->id_lembaga; ?>">
                  </div>     
                  <br>             
                    <label for="provinsi" class="col-sm-3 control-label">Jenis</label>
                    <div class="controls">
                      <select name="jenis" class="form-control" id="jenis">
                        <option value="0">Jurusan</option>
                        <option value="1">Fakultas</option>
                      </select>
                    </div>
                </div>
                <div class="modal-footer">
                  <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                  <button class="btn btn-success">Tambah</button>
                  </form>
                </div>
              </div> 
        </div>
      <!-- /widget -->
      </div>
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main