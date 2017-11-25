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
                  if ($datadivisi) {
             ?>
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Daftar Divisi</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped">
                <tbody>
                  <?php 
                      foreach ($datadivisi as $divisi) {
                  ?>
                  <tr>
                    <td> <?php echo $divisi->nama; ?> </td>
                    <td> 
                      <div align="right">
                        <a href="<?php echo site_url("divisi/pembimbing/$divisi->id_divisi");?>" role="button" class="btn-small btn-info"><i class="icon-user"></i> Pembimbing</a> 
                        <a href="#modalubah<?php echo $divisi->id_divisi; ?>" role="button" class="btn-small btn-warning" data-toggle="modal"><i class="icon-cog"></i> Ubah</a>
                        <a href="#modalhapus<?php echo $divisi->id_divisi; ?>" role="button" class="btn-small btn-danger" data-toggle="modal"><i class="icon-remove"></i> Hapus</a>                          
                      </div>

                      <div id="modalubah<?php echo $divisi->id_divisi; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalubahLabel<?php echo $divisi->id_divisi; ?>" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalubahLabel<?php echo $divisi->id_divisi; ?>">Ubah Divisi</h3>
                        </div>
                        <div class="modal-body">
                          <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('divisi/ubah');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="id_divisi" name="id_divisi" value="<?php echo $divisi->id_divisi; ?>">
                            </div>
                            <label class="control-label" for="nama">Nama</label>
                            <div class="controls">
                              <input type="text" id="nama" name="nama" value="<?php echo $divisi->nama; ?>">
                            </div>                
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                            <button class="btn btn-primary">Ubah</button>
                            </form>
                          </div>
                        </div>

                      <div id="modalhapus<?php echo $divisi->id_divisi; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalhapusLabel<?php echo $divisi->id_divisi; ?>" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalhapusLabel<?php echo $divisi->id_divisi; ?>">Hapus Divisi</h3>
                        </div>
                        <div class="modal-body">
                          <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('divisi/hapus');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="id_divisi" name="id_divisi" value="<?php echo $divisi->id_divisi; ?>">
                            </div>
                            <div class="controls">
                              Hapus divisi <strong><?php echo $divisi->nama; ?></strong>?
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
              <?php if ($datadivisi) { ?>
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
                  <h3 id="modaltambahLabel">Tambah Divisi</h3>
              </div>
              <div class="modal-body">
                <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('divisi/tambah');?>" method="post">
                  <label class="control-label" for="nama">Nama</label>
                  <div class="controls">
                    <input type="text" id="nama" name="nama">
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