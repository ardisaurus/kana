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
                if(!$this->session->userdata('cari_no_surat_keluar')){
             ?>
                <form id="edit-profile" class="form-horizontal" action="<?php echo site_url('surat/cari');?>" method="post">
                  <div class="control-group" align="right">                                           
                    <div class="controls">
                      <div class="input-append">
                        <input class="span2 m-wrap" id="appendedInputButton" name="cari_no_surat_keluar" id="cari_no_surat_keluar" type="text" placeholder="No Surat">
                        <button class="btn btn-primary" type="submit" name='submit' value='submit'><i class="icon-search"></i> Cari</button>
                        </form>
                      </div>
                    </div>  <!-- /controls -->      
                  </div> <!-- /control-group -->
            <?php }else{ ?>
                <form id="edit-profile" class="form-horizontal" action="<?php echo site_url('surat/cari');?>" method="post">
                  <div class="control-group" align="right">                                           
                    <div class="controls">
                      <div class="input-append">
                        <input class="span2 m-wrap" id="appendedInputButton" value="<?php echo $this->session->userdata('cari_no_surat_keluar'); ?>" type="text" disabled>
                        <a href="<?php echo site_url('surat');?>" class="btn btn-danger" ><i class="icon-remove"></i></a>
                        </form>
                      </div>
                    </div>  <!-- /controls -->      
                  </div> <!-- /control-group -->
            <?php } ?>
            <?php 
                  if ($datasurat) {
             ?>

          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Daftar Surat</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Surat Keluar </th>
                    <th> Kepada </th>
                    <th class="td-actions"> </th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      foreach ($datasurat as $surat) {
                  ?>
                  <tr>
                    <td> <?php echo $surat->no_surat_keluar; ?> </td>
                    <td> <?php echo $surat->kepada; ?> </td>
                    <td class="td-actions"><a href="<?php echo site_url("surat/detail/$surat->id_surat");?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-eye-open"> </i></a><a href="#modalhapus<?php echo $surat->id_surat; ?>" role="button" class="btn btn-small btn-danger" data-toggle="modal"><i class="icon-remove"></i></a></td>

                    <div id="modalhapus<?php echo $surat->id_surat; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalhapusLabel<?php echo $surat->id_surat; ?>" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalhapusLabel<?php echo $surat->id_surat; ?>">Hapus surat</h3>
                        </div>
                        <div class="modal-body">
                          <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('surat/hapussurat');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="id_surat" name="id_surat" value="<?php echo $surat->id_surat; ?>">
                            </div>
                            <div class="controls" align="center">
                              Hapus surat <strong><?php echo $surat->no_surat_keluar; ?></strong>?
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
                 <a href="<?php echo site_url('surat/formtambah');?>" role="button" class="btn btn-success"><i class="icon-plus"></i> Tambah</a>
              </div>
              <?php if ($datasurat) { ?>
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