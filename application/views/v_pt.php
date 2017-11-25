<!-- /subnavbar -->
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

            <?php 
                if(!$this->session->userdata('namapt')){
             ?>
                <form id="edit-profile" class="form-horizontal" action="<?php echo site_url('pt/cari');?>" method="post">
                  <div class="control-group" align="right">                                           
                    <div class="controls">
                      <div class="input-append">
                        <input class="span2 m-wrap" id="appendedInputButton" name="nama" id="nama" type="text" placeholder="Nama Perguruan Tinggi">
                        <button class="btn btn-primary" type="submit" name='submit' value='submit'><i class="icon-search"></i> Cari</button>
                        </form>
                      </div>
                    </div>  <!-- /controls -->      
                  </div> <!-- /control-group -->
            <?php }else{ ?>
                <form id="edit-profile" class="form-horizontal" action="<?php echo site_url('pt/cari');?>" method="post">
                  <div class="control-group" align="right">                                           
                    <div class="controls">
                      <div class="input-append">
                        <input class="span2 m-wrap" id="appendedInputButton" value="<?php echo $this->session->userdata('namapt'); ?>" type="text" disabled>
                        <a href="<?php echo site_url('pt');?>" class="btn btn-danger" ><i class="icon-remove"></i></a>
                        </form>
                      </div>
                    </div>  <!-- /controls -->      
                  </div> <!-- /control-group -->
            <?php } ?>
            <?php 
                  if ($datapendidikan) {
             ?>

          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Daftar Perguruan Tinggi</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped">
                <tbody>
                  <?php 
                      foreach ($datapendidikan as $pendidikan) {
                  ?>
                  <tr>
                    <td><?php echo $pendidikan->nama; ?> </td>
                    <td> 
                      <div align="right">
                        <a href="<?php echo site_url("pt/detaillembaga/$pendidikan->id_lembaga");?>" role="button" class="btn-small btn-info"><i class="icon-align-justify"></i> Detail</a>                         
                        <a href="#modalhapus<?php echo $pendidikan->id_lembaga; ?>" role="button" class="btn-small btn-danger" data-toggle="modal"><i class="icon-remove"></i> Hapus</a>                          
                      </div>                                          
                      <div id="modalhapus<?php echo $pendidikan->id_lembaga; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalhapusLabel<?php echo $pendidikan->id_lembaga; ?>" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalhapusLabel<?php echo $pendidikan->id_lembaga; ?>">Hapus pendidikan</h3>
                        </div>
                        <div class="modal-body">
                          <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('pt/hapuslembaga');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="id_lembaga" name="id_lembaga" value="<?php echo $pendidikan->id_lembaga; ?>">
                            </div>
                            <div class="controls">
                              Hapus pendidikan <strong><?php echo $pendidikan->nama; ?></strong>?
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
          <?php }else{ ?>
            <div class="alert alert-danger">
              Kosong
            </div>
          <?php } ?>
          <!-- /widget -->
            <div align="right">
              <div class="controls">
              <!-- Button to trigger modal -->
                 <a href="#modaltambah" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-plus"></i> Tambah</a>          
              </div>
              <?php if ($datapendidikan) { ?>
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
                  <h3 id="modaltambahLabel">Tambah Perguruan Tinggi</h3>
              </div>
              <div class="modal-body">
                <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('pt/tambahpt');?>" method="post">
                  <label class="control-label" for="nama">Nama</label>
                  <div class="controls">
                    <input type="text" id="nama" name="nama">
                  </div>
                  <br>
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
                  <br>
                  <label for="alamat" class="col-sm-3 control-label">Alamat</label>
                    <div class="controls">
                      <textarea name="alamat" id="alamat"></textarea>
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
<!-- /main -->