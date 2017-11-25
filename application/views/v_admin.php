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
                  if ($datapengurus) {
             ?>
          <div class="widget widget-table action-table">
            <div class="widget-header"> <i class="icon-th-list"></i>
              <h3>Daftar Admin</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th> Nama </th>
                    <th> Email </th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                      foreach ($datapengurus as $pengurus) {
                  ?>
                  <tr>
                    <td> <?php echo $pengurus->nama; ?> </td>
                    <td> <?php echo $pengurus->email; ?> </td>
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
              <?php if ($datapengurus) { ?>
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
                  <h3 id="modaltambahLabel">Tambah Admin</h3>
              </div>
              <div class="modal-body">
                <form id="tambah-admin" class="form-horizontal" action="<?php echo site_url('admin/tambah');?>" method="post">
                  <label class="control-label" for="nama">Nama</label>
                  <div class="controls">
                    <input type="text" id="nama" name="nama">
                  </div>
                  <br>
                  <label class="control-label" for="email">Email</label>
                  <div class="controls">
                    <input type="email" id="email" name="email">
                  </div>
                  <br>
                  <label class="control-label" for="passwordbaru">Kata Sandi</label>
                  <div class="controls">
                    <input type="password" id="passwordbaru" name="passwordbaru">
                    <p class="help-block"><i class="icon-info-sign"></i> Masukan kombinasi antara 6-12 karakter.</p>
                  </div>
                  <br>
                  <label class="control-label" for="passwordbaru2"></label>
                  <div class="controls">
                    <input type="password" id="passwordbaru2" name="passwordbaru2">
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