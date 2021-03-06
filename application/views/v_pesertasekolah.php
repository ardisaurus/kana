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
                if(!$this->session->userdata('namapesertasekolah')){
             ?>
                <form id="edit-profile" class="form-horizontal" action="<?php echo site_url('pesertasekolah/cari');?>" method="post">
                  <div class="control-group" align="right">                                           
                    <div class="controls">
                      <div class="input-append">
                        <input class="span2 m-wrap" id="appendedInputButton" name="nama" id="nama" type="text" placeholder="Nama Peserta">
                        <button class="btn btn-primary" type="submit" name='submit' value='submit'><i class="icon-search"></i> Cari</button>
                        </form>
                      </div>
                    </div>  <!-- /controls -->      
                  </div> <!-- /control-group -->
            <?php }else{ ?>
                <form id="edit-profile" class="form-horizontal" action="<?php echo site_url('pesertasekolah/cari');?>" method="post">
                  <div class="control-group" align="right">                                           
                    <div class="controls">
                      <div class="input-append">
                        <input class="span2 m-wrap" id="appendedInputButton" value="<?php echo $this->session->userdata('namapesertasekolah'); ?>" type="text" disabled>
                        <a href="<?php echo site_url('pesertasekolah');?>" class="btn btn-danger" ><i class="icon-remove"></i></a>
                        </form>
                      </div>
                    </div>  <!-- /controls -->      
                  </div> <!-- /control-group -->
            <?php } ?>
            <?php 
                  if ($datapeserta) {
             ?>

          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Daftar Peserta dari Sekolah</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Nama </th>
                    <th> Sekolah</th>
                    <th> Divisi</th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      foreach ($datapeserta as $peserta) {
                  ?>
                  <tr>
                    <td> <?php echo $peserta->nama_peserta; ?> </td>
                    <td> <?php echo $peserta->nama_pendidikan; ?> </td>
                    <td> <?php echo $peserta->nama_divisi; ?> </td>
                    <td class="td-actions"><a href="<?php echo site_url("pesertasekolah/detail/$peserta->id_peserta");?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-eye-open"> </i></a><a href="#modalhapus<?php echo $peserta->id_peserta; ?>" role="button" class="btn btn-small btn-danger" data-toggle="modal"><i class="icon-remove"></i></a></td>

                    <div id="modalhapus<?php echo $peserta->id_peserta; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalhapusLabel<?php echo $peserta->id_peserta; ?>" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalhapusLabel<?php echo $peserta->id_peserta; ?>">Hapus peserta</h3>
                        </div>
                        <div class="modal-body">
                          <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('pesertasekolah/hapuspeserta');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="id_peserta" name="id_peserta" value="<?php echo $peserta->id_peserta; ?>">
                            </div>
                            <div class="controls" align="center">
                              Hapus peserta <strong><?php echo $peserta->nama_peserta; ?></strong>?
                            </div>                  
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                            <button class="btn btn-danger">Hapus</button>
                            </form>
                          </div>
                        </div>

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
                 <a href="<?php echo site_url('pesertasekolah/formtambah');?>" role="button" class="btn btn-success"><i class="icon-plus"></i> Tambah</a>
              </div>
              <?php if ($datapeserta) { ?>
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
        </div>
      <!-- /widget -->
      </div>
    </div>
    <!-- /container --> 
  </div>
  <!-- /main-inner --> 
</div>
<!-- /main -->