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
          if ($datapembimbing) {
        ?>
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-user"></i>
              <h3>Daftar Pembimbing <?php foreach ($datanamadivisi as $divisi) {echo $divisi->nama;} ?></h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped">
                <tbody>
                  <?php 
                      foreach ($datapembimbing as $pembimbing) {
                  ?>
                  <tr>
                    <td> <?php echo $pembimbing->nama; ?> </td>
                    <td> 
                      <div align="right"> 
                        <a href="#modalubah<?php echo $pembimbing->id_pembimbing; ?>" role="button" class="btn-small btn-warning" data-toggle="modal"><i class="icon-cog"></i> Ubah</a>
                        <a href="#modalhapus<?php echo $pembimbing->id_pembimbing; ?>" role="button" class="btn-small btn-danger" data-toggle="modal"><i class="icon-remove"></i> Hapus</a>                          
                      </div>

                      <div id="modalubah<?php echo $pembimbing->id_pembimbing; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalubahLabel<?php echo $pembimbing->id_pembimbing; ?>" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalubahLabel<?php echo $pembimbing->id_pembimbing; ?>">Ubah pembimbing</h3>
                        </div>
                        <div class="modal-body">
                          <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('divisi/ubahpembimbing');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="id_divisi" name="id_divisi" value="<?php echo $pembimbing->id_divisi; ?>">
                              <input type="hidden" id="id_pembimbing" name="id_pembimbing" value="<?php echo $pembimbing->id_pembimbing; ?>">
                            </div>
                            <label class="control-label" for="nama">Nama</label>
                            <div class="controls">
                              <input type="text" id="nama" name="nama" value="<?php echo $pembimbing->nama; ?>">
                            </div>                
                          </div>
                          <div class="modal-footer">
                            <button class="btn" data-dismiss="modal" aria-hidden="true">Batal</button>
                            <button class="btn btn-primary">Ubah</button>
                            </form>
                          </div>
                        </div>

                      <div id="modalhapus<?php echo $pembimbing->id_pembimbing; ?>" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="modalhapusLabel<?php echo $pembimbing->id_pembimbing; ?>" aria-hidden="true">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                            <h3 id="modalhapusLabel<?php echo $pembimbing->id_pembimbing; ?>">Hapus Pembimbing</h3>
                        </div>
                        <div class="modal-body">
                          <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('divisi/hapuspembimbing');?>" method="post">
                            <div class="controls">
                              <input type="hidden" id="id_pembimbing" name="id_pembimbing" value="<?php echo $pembimbing->id_pembimbing; ?>">
                            </div>
                            <div class="controls">
                              <input type="hidden" id="id_divisi" name="id_divisi" value="<?php echo $pembimbing->id_divisi; ?>">
                            </div>
                            <div class="controls">
                              Hapus pembimbing <strong><?php echo $pembimbing->nama; ?></strong>?
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
              Data pembimbing <strong><?php foreach ($datanamadivisi as $divisi) {echo $divisi->nama;} ?></strong> kosong
            </div>
          <?php } ?>
            <div align="right">
              <div class="controls">
              <!-- Button to trigger modal -->
                 <a href="#modaltambah" role="button" class="btn btn-success" data-toggle="modal"><i class="icon-plus"></i> Tambah</a>          
              </div>
              <?php if ($datapembimbing) { ?>
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
                  <h3 id="modaltambahLabel">Tambah Pembimbing</h3>
              </div>
              <div class="modal-body">
                <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('divisi/tambahpembimbing');?>" method="post">
                  <label class="control-label" for="nama">Nama</label>
                  <div class="controls">
                    <input type="text" id="nama" name="nama">                    
                    <input type="hidden" id="id_divisi" name="id_divisi" value="<?php foreach ($datanamadivisi as $divisi) {echo $divisi->id_divisi;} ?>">
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